<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class CheckpointreportController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
        
    }

    /**
     * Searches for checkpointreport
     */
    public function searchAction()
    {
           
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Checkpointreport', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $checkpointreport = Checkpointreport::find($parameters);
        if (count($checkpointreport) == 0) {
            $this->flash->notice("The search did not find any checkpointreport");

            $this->dispatcher->forward([
                "controller" => "checkpointreport",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $checkpointreport,
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
     * Edits a checkpointreport
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $checkpointreport = Checkpointreport::findFirstByid($id);
            if (!$checkpointreport) {
                $this->flash->error("checkpointreport was not found");

                $this->dispatcher->forward([
                    'controller' => "checkpointreport",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $checkpointreport->id;

            $this->tag->setDefault("id", $checkpointreport->id);
            $this->tag->setDefault("checkpointId", $checkpointreport->checkpointId);
            $this->tag->setDefault("runnerId", $checkpointreport->runnerId);
            $this->tag->setDefault("time", $checkpointreport->time);
            
        }
    }

    /**
     * Creates a new checkpointreport
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "checkpointreport",
                'action' => 'index'
            ]);

            return;
        }

        $checkpointreport = new Checkpointreport();
        $checkpointreport->Checkpointid = $this->request->getPost("checkpointId");
        $checkpointreport->Runnerid = $this->request->getPost("runnerId");
        $checkpointreport->Time = $this->request->getPost("time");
        

        if (!$checkpointreport->save()) {
            foreach ($checkpointreport->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "checkpointreport",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("checkpointreport was created successfully");

        $this->dispatcher->forward([
            'controller' => "checkpointreport",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a checkpointreport edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "checkpointreport",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $checkpointreport = Checkpointreport::findFirstByid($id);

        if (!$checkpointreport) {
            $this->flash->error("checkpointreport does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "checkpointreport",
                'action' => 'index'
            ]);

            return;
        }

        $checkpointreport->Checkpointid = $this->request->getPost("checkpointId");
        $checkpointreport->Runnerid = $this->request->getPost("runnerId");
        $checkpointreport->Time = $this->request->getPost("time");
        

        if (!$checkpointreport->save()) {

            foreach ($checkpointreport->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "checkpointreport",
                'action' => 'edit',
                'params' => [$checkpointreport->id]
            ]);

            return;
        }

        $this->flash->success("checkpointreport was updated successfully");

        $this->dispatcher->forward([
            'controller' => "checkpointreport",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a checkpointreport
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $checkpointreport = Checkpointreport::findFirstByid($id);
        if (!$checkpointreport) {
            $this->flash->error("checkpointreport was not found");

            $this->dispatcher->forward([
                'controller' => "checkpointreport",
                'action' => 'index'
            ]);

            return;
        }

        if (!$checkpointreport->delete()) {

            foreach ($checkpointreport->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "checkpointreport",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("checkpointreport was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "checkpointreport",
            'action' => "index"
        ]);
    }

}
