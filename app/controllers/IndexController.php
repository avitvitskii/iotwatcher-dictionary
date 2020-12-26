<?php


class IndexController extends ControllerBase
{
    public function indexAction()
    {
        $params = $this->dispatcher->getParams();
        if ($params[0] === "mindmap") {
            $this->view->pick('index/mindmap');
            return;
        }
        if ($this->request->isPost()) {
            $request = $this->request->getPost('word');
            $this->response->redirect("/$request");
            return;
        }
        if (!$params) {
            $this->view->pick('index/index');
            return;
        }
        $request = end($params);
        $model = new Words();
        $word_data = $model->getWord($request);
        if (!$word_data["description"]) {
            $this->view->message = $request . " was not found. Please try again.";
        }
        $this->view->word = $word_data["word"];
        $this->view->children = $word_data["children"];
        $this->view->output = $word_data["description"];
    }
}

