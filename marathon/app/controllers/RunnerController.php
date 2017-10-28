<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class RunnerController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for runner
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            
            $query = Criteria::fromInput($this->di, 'Runner', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            
            $parameters = [];
        }
        $parameters["order"] = "id";

        $runner = Runner::find($parameters);
        if (count($runner) == 0) {
            $this->flash->notice("The search did not find any runner");
            $parameters =null;
        $runner = Runner::find($parameters);
        
        }

        $paginator = new Paginator([
            'data' => $runner,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a runner
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $runner = Runner::findFirstByid($id);
            if (!$runner) {
                $this->flash->error("runner was not found");

                $this->dispatcher->forward([
                    'controller' => "runner",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $runner->id;

            $this->tag->setDefault("id", $runner->id);
            $this->tag->setDefault("fname", $runner->fname);
            $this->tag->setDefault("lname", $runner->lname);
            $this->tag->setDefault("sSID", $runner->sSID);
            $this->tag->setDefault("tel", $runner->tel);
            $this->tag->setDefault("username", $runner->username);
            $this->tag->setDefault("password", $runner->password);
            
        }
    }

    /**
     * Creates a new runner
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "runner",
                'action' => 'index'
            ]);

            return;
        }

        $runner = new Runner();
        $runner->fname = $this->request->getPost("Fname");
        $runner->lname = $this->request->getPost("Lname");
        $runner->sSID = $this->request->getPost("SSID");
        $runner->tel = $this->request->getPost("Tel");
        $runner->username = $this->request->getPost("username");
        $runner->password = $this->request->getPost("Password");
        

        if (!$runner->save()) {
            foreach ($runner->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "runner",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("runner was created successfully");

        $this->dispatcher->forward([
            'controller' => "runner",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a runner edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "runner",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $runner = Runner::findFirstByid($id);

        if (!$runner) {
            $this->flash->error("runner does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "runner",
                'action' => 'index'
            ]);

            return;
        }

        $runner->fname = $this->request->getPost("Fname");
        $runner->lname = $this->request->getPost("Lname");
        $runner->sSID = $this->request->getPost("SSID");
        $runner->tel = $this->request->getPost("Tel");
        $runner->username = $this->request->getPost("username");
        $runner->password = $this->request->getPost("Password");
        

        if (!$runner->save()) {

            foreach ($runner->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "runner",
                'action' => 'edit',
                'params' => [$runner->id]
            ]);

            return;
        }

        $this->flash->success("runner was updated successfully");

        $this->dispatcher->forward([
            'controller' => "runner",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a runner
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $runner = Runner::findFirstByid($id);
        if (!$runner) {
            $this->flash->error("runner was not found");

            $this->dispatcher->forward([
                'controller' => "runner",
                'action' => 'index'
            ]);

            return;
        }

        if (!$runner->delete()) {

            foreach ($runner->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "runner",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("runner was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "runner",
            'action' => "index"
        ]);
    }

}
