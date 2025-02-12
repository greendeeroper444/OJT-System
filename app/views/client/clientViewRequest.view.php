<!-- Component imported from Modules (Layout/Modules) -->

<link rel="stylesheet" href="<?php echo PARENT_FOLDER ?>/public/css/client/viewrequest.css">

<?php ($data['viewType'] == 'PIO') ? include_once(ROOT . '/app/views/layout/components/PIOServiceForm.php') : null ?>
<?php ($data['viewType'] == 'PHOTO') ? include_once(ROOT . '/app/views/layout/components/PHOTORequestForm.php') : null ?>
<?php ($data['viewType'] == 'POSTING') ? include_once(ROOT . '/app/views/layout/components/POSTINGApprovalForm.php') : null ?>



<?php

if (isset($_SESSION['page_Success'])) {
    $url = PARENT_FOLDER . '/client/dashboard';
    echo "
            <script> 
                Swal.fire({
                    text: '" . $_SESSION['page_Success'] . "',
                    icon: 'success',
                    confirmButtonColor: '#0B790B',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                   
                });
            </script>
            ";
}
unset($_SESSION['page_Success']);


?>