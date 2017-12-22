
<?php use phplist\Caixa\Functionality\Domain\Model\ClientInvestmentLog;
/** @var \phplist\Caixa\Functionality\Domain\Model\ClientInvestmentLog[] $clientsNoEmail */ ?>

<?php if (!empty($_SESSION['action_result'])): ?>
    <div class="actionresult"><?= $_SESSION['action_result']; ?></div>
    <?php unset($_SESSION['action_result']); ?>
<?php endif; ?>


<?php

$myTable = new WebblerListing("ID");
$numberPerPage = 10;
$total = count($unseenemails);

if (isset($_GET["start"])) {
    $start = $_GET["start"];  // The index of the current page is passed as the "start" parameter in the URL
} else {
    $start = 0;
}

if (!$total) {
    $myTable->addElement('<strong>Relatório</strong>', ''); //
} else {
   
    for ($i = 0; $i < $numberPerPage; $i++) { // Create a table of proper length for the page.
        $current = $start + $i;
        if($current >= $total){
            $start = $current - $numberPerPage;
            $current = $start;
        }
       
        $message = $unseenemails[$current];
 
        $id = $message['id'];
        $myTable->addElement($message['id'], '', 'ID');
                            //$name, $column_name, $value, $url = '', $align = ''
        $myTable->addColumn($id, 'Assunto',  $message['subject'], PageURL2("noviewstatistics&action=unreademails&id={$id}"));
        $myTable->addColumn($id, 'Criada Em', (new DateTime($message['entered']))->format('d-m-Y'));
        $myTable->addColumn($id, 'Status', $message['status']);
        $myTable->addColumn($id, 'Enviada Em', (new DateTime($message['sent']))->format('d-m-Y'));
     
    }
    
    $paging=simplePaging("noviewstatistics", $start, $total, $numberPerPage,'campanhas');
    $myTable->usePanel($paging);  // Pass the paging to the $myTable object
}

// Now put the correct title on the table and print it
$html = $myTable->display();
$oldTitle = 'ID';
$newTitle = 'Lista de Campanhas';
$needle = '<div class="panel"><div class="header"><h2>' . $oldTitle . '</h2></div>';
$replace = '<div class="panel"><div class="header"><h2>' . $newTitle . '</h2></div>';

$retorno = str_replace($needle, $replace, $html);

echo $retorno;
?>

