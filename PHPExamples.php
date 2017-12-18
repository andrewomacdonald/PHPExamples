public function editAction()
{
    $this->requirePut();
    $id = $this->requireId();
    $item = $this->manager->getById($id);
    if (null === $item) {
        throw new ItemNotFoundException($this->_("{err_match_not_found}"), "match", "id", $id);
    }
}

$data = $this->requireJson();
$item = $this->manager->update($id, $data);
    if (is_array($item)) {
        $response = new Response(array("errors" => $item['messages']), false, $this->_('{fail_validate_match}'));
        return $this->setStatusCode(400, $response);
    } else {
        $response = new Response($item, true, $this->_('{success_update_match}'));
        return $this->setStatusCode(200, $response);
    }
}



/**
* Deletes a match
*
* @return null|\Zend\Stdlib\ResponseInterface|\Zend\View\Model\JsonModel
*/
public function deleteAction()
{
    $this->requireDelete();
    $id = $this->requireId();
    $result = $this->manager->delete($id);
    if ($result) {
        $response = new Response($result, true, $this->_('{success_delete_match}'));
        return $this->setStatusCode(200, $response);
    } else {
        $response = new Response($result, false, $this->_("{err_match_not_found}"));
        return $this->setStatusCode(404, $response);
    }
}