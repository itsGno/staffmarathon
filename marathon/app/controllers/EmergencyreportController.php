<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class EmergencyreportController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for emergencyreport
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Emergencyreport', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $emergencyreport = Emergencyreport::find($parameters);
        if (count($emergencyreport) == 0) {
         //   $this->flash->notice("The search did not find any emergencyreport");
            $parameters = null;
        $emergencyreport = Emergencyreport::find($parameters);
        
    
        }

        $paginator = new Paginator([
            'data' => $emergencyreport,
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
     * Edits a emergencyreport
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $emergencyreport = Emergencyreport::findFirstByid($id);
            if (!$emergencyreport) {
                $this->flash->error("emergencyreport was not found");

                $this->dispatcher->forward([
                    'controller' => "emergencyreport",
                    'action' => 'search'
                ]);

                return;
            }

            $this->view->id = $emergencyreport->id;

            $this->tag->setDefault("id", $emergencyreport->id);
            $this->tag->setDefault("header", $emergencyreport->header);
            $this->tag->setDefault("detail", $emergencyreport->detail);
            $this->tag->setDefault("runnerId", $emergencyreport->runnerId);
            $this->tag->setDefault("staffId", $emergencyreport->staffId);
            $this->tag->setDefault("lag", $emergencyreport->lag);
            $this->tag->setDefault("lng", $emergencyreport->lng);
            $this->tag->setDefault("status", $emergencyreport->status);
            $this->tag->setDefault("level", $emergencyreport->level);
            
        }
    }

    /**
     * Creates a new emergencyreport
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "emergencyreport",
                'action' => 'search'
            ]);

            return;
        }

        $emergencyreport = new Emergencyreport();
        $emergencyreport->header = $this->request->getPost("header");
        $emergencyreport->detail = $this->request->getPost("detail");
        $emergencyreport->runnerId = $this->request->getPost("runnerId");
        $emergencyreport->staffId = $this->request->getPost("staffId");
        $emergencyreport->lag = $this->request->getPost("lag");
        $emergencyreport->lng = $this->request->getPost("lng");
        $emergencyreport->status = $this->request->getPost("status");
        $emergencyreport->level = $this->request->getPost("level");
        
        $runner = Runner::findFirstByid($emergencyreport->runnerId);
        if($runner==null){
            $this->flash->error("runner id does not exist " . $emergencyreport->runnerId);
            $this->dispatcher->forward([
                'controller' => "emergencyreport",
                'action' => 'new'
            ]);

            return;
        }        
        if (!$emergencyreport->save()) {
            foreach ($emergencyreport->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "emergencyreport",
                'action' => 'new'
            ]);

            return;
        }
    

        $this->flash->success("emergencyreport was created successfully");

        $this->dispatcher->forward([
            'controller' => "emergencyreport",
            'action' => 'search'
        ]);
    }

    /**
     * Saves a emergencyreport edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "emergencyreport",
                'action' => 'search'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $emergencyreport = Emergencyreport::findFirstByid($id);

        if (!$emergencyreport) {
            $this->flash->error("emergencyreport does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "emergencyreport",
                'action' => 'search'
            ]);

            return;
        }

        $emergencyreport->header = $this->request->getPost("header");
        $emergencyreport->detail = $this->request->getPost("detail");
        $emergencyreport->runnerId = $this->request->getPost("runnerId");
        $emergencyreport->staffId = $this->request->getPost("staffId");
        $emergencyreport->lag = $this->request->getPost("lag");
        $emergencyreport->lng = $this->request->getPost("lng");
        $emergencyreport->status = $this->request->getPost("status");
        $emergencyreport->level = $this->request->getPost("level");
        

        if (!$emergencyreport->save()) {

            foreach ($emergencyreport->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "emergencyreport",
                'action' => 'edit',
                'params' => [$emergencyreport->id]
            ]);

            return;
        }

        $this->flash->success("emergencyreport was updated successfully");

        $this->dispatcher->forward([
            'controller' => "emergencyreport",
            'action' => 'search'
        ]);
    }

    /**
     * Deletes a emergencyreport
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $emergencyreport = Emergencyreport::findFirstByid($id);
        if (!$emergencyreport) {
            $this->flash->error("emergencyreport was not found");

            $this->dispatcher->forward([
                'controller' => "emergencyreport",
                'action' => 'index'
            ]);

            return;
        }

        if (!$emergencyreport->delete()) {

            foreach ($emergencyreport->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "emergencyreport",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("emergencyreport was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "emergencyreport",
            'action' => "index"
        ]);
    }

}
