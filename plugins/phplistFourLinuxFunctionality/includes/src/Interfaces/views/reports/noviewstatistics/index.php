
<?php use phplist\Caixa\Functionality\Domain\Model\ClientInvestmentLog;
/** @var \phplist\Caixa\Functionality\Domain\Model\ClientInvestmentLog[] $clientsNoEmail */ ?>

<?php if (!empty($_SESSION['action_result'])): ?>
    <div class="actionresult"><?= $_SESSION['action_result']; ?></div>
    <?php unset($_SESSION['action_result']); ?>
<?php endif; ?>


<?php
$total = count($unseenemails);

$numberPerPage = 10;
$myTable = new WebblerListing('ID');

$myTable->usePanel(simplePaging('noviewstatistics', $start, $total, $numberPerPage));

foreach ($unseenemails as $message) {

        $id = $message['id'];
        $myTable->addElement($message['id'], '', 'ID');
                            //$name, $column_name, $value, $url = '', $align = ''
        $myTable->addColumn($id, 'Assunto',  $message['subject'], PageURL2("noviewstatistics&action=unreademails&id={$id}"));
        $myTable->addColumn($id, 'Criada Em', (new DateTime($message['entered']))->format('d-m-Y'));
        $myTable->addColumn($id, 'Status', $message['status']);
        $myTable->addColumn($id, 'Enviada Em', (new DateTime($message['sent']))->format('d-m-Y'));
}

$needle = '<div class="header"><h2>ID</h2></div>';
$replace = '<div class="header"><h2>Listagem das campanhas</h2></div>';
$tableDisplay = str_replace($needle, $replace, $myTable->display());
?>

<?= $tableDisplay; ?>