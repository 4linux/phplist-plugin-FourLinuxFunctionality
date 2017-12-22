
<?php use phplist\Caixa\Functionality\Domain\Model\ClientInvestmentLog;
/** @var \phplist\Caixa\Functionality\Domain\Model\ClientInvestmentLog[] $clientsNoEmail */ ?>

<?php if (!empty($_SESSION['action_result'])): ?>
    <div class="actionresult"><?= $_SESSION['action_result']; ?></div>
    <?php unset($_SESSION['action_result']); ?>
<?php endif; ?>


<?php

if(! $unseenemails){
    echo '<h2> Não há registros para serem exibidos </h2>';
    echo '<a href="' . PageURL2("noviewstatistics") . '"> voltar</a>';
    exit();
}

$myTable = new WebblerListing("ID");
$numberPerPage = 10;
$total = count($unseenemails);

if (isset($_GET["start"])) {
    $start = $_GET["start"];  // The index of the current page is passed as the "start" parameter in the URL
} else {
    $start = 0;
}

if (! $total) {
    $myTable->addElement('<strong>Relatório</strong>', ''); //
} else {
    for ($i = 0; $i < $numberPerPage; $i++) { // Create a table of proper length for the page.
        $current = $start + $i;
        if($current >= $total){
            $start = $current - $numberPerPage;
            $current = $start;
        }
        
        $user = $unseenemails[$current];
        $messageId = $user['messageid'];
       
        $id = $user['userid'];
        $myTable->addElement($user['userid'], '', 'ID');
                            //$name, $column_name, $value, $url = '', $align = ''
        $myTable->addColumn($id, 'E-mail',  $user['email']); 

    }
    
    $paging=simplePaging("noviewstatistics", $start, $total, $numberPerPage, 'usuários');
    $myTable->usePanel($paging);  // Pass the paging to the $myTable object
}

$myTable->addButton('Exportar CSV', PageURL2("noviewstatistics&action=exportusers&messageid={$messageId}"));
// Now put the correct title on the table and print it
$html = $myTable->display();
$oldTitle = 'ID';
$newTitle = 'Lista de usuários que não viram a mensagem';
$needle = '<div class="panel"><div class="header"><h2>' . $oldTitle . '</h2></div>';
$replace = '<div class="panel"><div class="header"><h2>' . $newTitle . '</h2></div>';

$retorno = str_replace($needle, $replace, $html);

echo $retorno;
?>

