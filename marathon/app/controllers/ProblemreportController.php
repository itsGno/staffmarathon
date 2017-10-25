<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ProblemreportController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for problemreport
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Problemreport', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $problemreport = Problemreport::find($parameters);
        if (count($problemreport) == 0) {
            $this->flash->notice("The search did not find any problemreport");

            $this->dispatcher->forward([
                "controller" => "problemreport",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $problemreport,
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
     * Edits a problemreport
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $problemreport = Problemreport::findFirstByid($id);
            if (!$problemreport) {
                $this->flash->error("problemreport was not found");

                $this->dispatcher->forward([
                    'controller' => "problemreport",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $problemreport->id;

            $this->tag->setDefault("id", $problemreport->id);
            $this->tag->setDefault("header", $problemreport->header);
            $this->tag->setDefault("detail", $problemreport->detail);
            $this->tag->setDefault("senderId", $problemreport->senderId);
            $this->tag->setDefault("staffId", $problemreport->staffId);
            $this->tag->setDefault("lag", $problemreport->lag);
            $this->tag->setDefault("lng", $problemreport->lng);
            $this->tag->setDefault("status", $problemreport->status);
            $this->tag->setDefault("level", $problemreport->level);
            
        }
    }

    /**
     * Creates a new problemreport
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "problemreport",
                'action' => 'index'
            ]);

            return;
        }

        $problemreport = new Problemreport();
        $problemreport->header = $this->request->getPost("header");
        $problemreport->detail = $this->request->getPost("detail");
        $problemreport->senderId = $this->request->getPost("senderId");
        $problemreport->staffId = $this->request->getPost("staffId");
        $problemreport->lag = $this->request->getPost("lag");
        $problemreport->lng = $this->request->getPost("lng");
        $problemreport->status = $this->request->getPost("status");
        $problemreport->level = $this->request->getPost("level");
        

        if (!$problemreport->save()) {
            foreach ($problemreport->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "problemreport",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("problemreport was created successfully");

        $this->dispatcher->forward([
            'controller' => "problemreport",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a problemreport edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "problemreport",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $problemreport = Problemreport::findFirstByid($id);

        if (!$problemreport) {
            $this->flash->error("problemreport does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "problemreport",
                'action' => 'index'
            ]);

            return;
        }

        $problemreport->header = $this->request->getPost("header");
        $problemreport->detail = $this->request->getPost("detail");
        $problemreport->senderId = $this->request->getPost("senderId");
        $problemreport->staffId = $this->request->getPost("staffId");
        $problemreport->lag = $this->request->getPost("lag");
        $problemreport->lng = $this->request->getPost("lng");
        $problemreport->status = $this->request->getPost("status");
        $problemreport->level = $this->request->getPost("level");
        

        if (!$problemreport->save()) {

            foreach ($problemreport->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "problemreport",
                'action' => 'edit',
                'params' => [$problemreport->id]
            ]);

            return;
        }

        $this->flash->success("problemreport was updated successfully");

        $this->dispatcher->forward([
            'controller' => "problemreport",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a problemreport
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $problemreport = Problemreport::findFirstByid($id);
        if (!$problemreport) {
            $this->flash->error("problemreport was not found");

            $this->dispatcher->forward([
                'controller' => "problemreport",
                'action' => 'index'
            ]);

            return;
        }

        if (!$problemreport->delete()) {

            foreach ($problemreport->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "problemreport",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("problemreport was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "problemreport",
            'action' => "index"
        ]);
    }

}
