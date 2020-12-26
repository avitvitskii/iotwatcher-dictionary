<?php


class Words extends \Core\Model
{
    public $id;
    public $request;
    public $word;
    public $description;
    public $parent;

    public function getWord($word_request) : Array {
        $saved_word = Words::findFirst(
            [
                'conditions' => 'request = :request:',
                'bind' => [
                    'request' => $word_request,
                ]
            ]
        );
        $children = Words::find(
            [
                'conditions' => 'parent = :parent:',
                'bind' => [
                    'parent' => $saved_word->id,
                ]
            ]
        );
        $children_requests = [];
        foreach ($children as $child) {
            $children_requests[] = $child->request;
        }
        return [
            "word" => $saved_word->word,
            "description" => $saved_word->description,
            "children" => $children_requests
        ];
//        die(var_dump($response));
//        $new_params = [$saved_word->word];
//        while ($saved_word->parent) {
//            $parent = $saved_word->parent;
//            $saved_word = Words::findFirst(
//                [
//                    'conditions' => 'word = :word:',
//                    'bind' => [
//                        'word' => $parent,
//                    ]
//                ]
//            );
//            if ($saved_word) {
//                array_unshift($new_params, $saved_word->word);
//            }
//        }
//        die(var_dump($new_params));
//        return $saved_word;
//        $parents = [];
//        while(!!$saved_word->parent) {
//
//        }
//        $parent[] =
    }

}