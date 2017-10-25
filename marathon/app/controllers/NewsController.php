<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class NewsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for news
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'News', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $news = News::find($parameters);
        if (count($news) == 0) {
            $this->flash->notice("The search did not find any news");

            $this->dispatcher->forward([
                "controller" => "news",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $news,
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
     * Edits a new
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $new = News::findFirstByid($id);
            if (!$new) {
                $this->flash->error("new was not found");

                $this->dispatcher->forward([
                    'controller' => "news",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $new->id;

            $this->tag->setDefault("id", $new->id);
            $this->tag->setDefault("header", $new->header);
            $this->tag->setDefault("detail", $new->detail);
            $this->tag->setDefault("author", $new->author);
            
        }
    }

    /**
     * Creates a new new
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "news",
                'action' => 'index'
            ]);

            return;
        }

        $new = new News();
        $new->Header = $this->request->getPost("header");
        $new->Detail = $this->request->getPost("detail");
        $new->Author = $this->request->getPost("author");
        

        if (!$new->save()) {
            foreach ($new->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "news",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("new was created successfully");

        $this->dispatcher->forward([
            'controller' => "news",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a new edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "news",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $new = News::findFirstByid($id);

        if (!$new) {
            $this->flash->error("new does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "news",
                'action' => 'index'
            ]);

            return;
        }

        $new->Header = $this->request->getPost("header");
        $new->Detail = $this->request->getPost("detail");
        $new->Author = $this->request->getPost("author");
        

        if (!$new->save()) {

            foreach ($new->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "news",
                'action' => 'edit',
                'params' => [$new->id]
            ]);

            return;
        }

        $this->flash->success("new was updated successfully");

        $this->dispatcher->forward([
            'controller' => "news",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a new
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $new = News::findFirstByid($id);
        if (!$new) {
            $this->flash->error("new was not found");

            $this->dispatcher->forward([
                'controller' => "news",
                'action' => 'index'
            ]);

            return;
        }

        if (!$new->delete()) {

            foreach ($new->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "news",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("new was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "news",
            'action' => "index"
        ]);
    }

}
