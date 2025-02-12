<!-- Component imported from Modules (Layout/Modules) -->
<link rel="stylesheet" href="<?php echo PARENT_FOLDER ?>/public/css/client/viewrequest.css">


<?php ($data['viewType'] == 'PIO') ? include_once(ROOT . '/app/views/layout/components/PIOServiceForm.php') : null ?>
<?php ($data['viewType'] == 'PHOTO') ? include_once(ROOT . '/app/views/layout/components/PHOTORequestForm.php') : null ?>
<?php ($data['viewType'] == 'POSTING') ? include_once(ROOT . '/app/views/layout/components/POSTINGApprovalForm.php') : null ?>

