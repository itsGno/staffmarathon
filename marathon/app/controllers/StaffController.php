<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class StaffController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for staff
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Staff', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $staff = Staff::find($parameters);
        if (count($staff) == 0) {
            $this->flash->notice("The search did not find any staff");

            $this->dispatcher->forward([
                "controller" => "staff",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $staff,
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
     * Edits a staff
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $staff = Staff::findFirstByid($id);
            if (!$staff) {
                $this->flash->error("staff was not found");

                $this->dispatcher->forward([
                    'controller' => "staff",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $staff->id;

            $this->tag->setDefault("id", $staff->id);
            $this->tag->setDefault("Fname", $staff->Fname);
            $this->tag->setDefault("Lname", $staff->Lname);
            $this->tag->setDefault("category", $staff->category);
            $this->tag->setDefault("username", $staff->username);
            $this->tag->setDefault("password", $staff->password);
            
        }
    }

    /**
     * Creates a new staff
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "staff",
                'action' => 'index'
            ]);

            return;
        }

        $staff = new Staff();
        $staff->Fname = $this->request->getPost("Fname");
        $staff->Lname = $this->request->getPost("Lname");
        $staff->Category = $this->request->getPost("category");
        $staff->Username = $this->request->getPost("username");
        $staff->Password = $this->request->getPost("password");
        

        if (!$staff->save()) {
            foreach ($staff->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "staff",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("staff was created successfully");

        $this->dispatcher->forward([
            'controller' => "staff",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a staff edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "staff",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $staff = Staff::findFirstByid($id);

        if (!$staff) {
            $this->flash->error("staff does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "staff",
                'action' => 'index'
            ]);

            return;
        }

        $staff->Fname = $this->request->getPost("Fname");
        $staff->Lname = $this->request->getPost("Lname");
        $staff->Category = $this->request->getPost("category");
        $staff->Username = $this->request->getPost("username");
        $staff->Password = $this->request->getPost("password");
        

        if (!$staff->save()) {

            foreach ($staff->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "staff",
                'action' => 'edit',
                'params' => [$staff->id]
            ]);

            return;
        }

        $this->flash->success("staff was updated successfully");

        $this->dispatcher->forward([
            'controller' => "staff",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a staff
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $staff = Staff::findFirstByid($id);
        if (!$staff) {
            $this->flash->error("staff was not found");

            $this->dispatcher->forward([
                'controller' => "staff",
                'action' => 'index'
            ]);

            return;
        }

        if (!$staff->delete()) {

            foreach ($staff->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "staff",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("staff was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "staff",
            'action' => "index"
        ]);
    }

}
