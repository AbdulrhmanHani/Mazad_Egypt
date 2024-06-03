<?php
require_once("../../app.php");

use MazadEgypt\Classes\Models\Contact;

$co = new Contact;

if ($request->getHas("id")) {
    $id = $request->get("id");
    $co->delete($id);
    $request->aredirect("messages.php");
} else {
    $request->aredirect("");
}
