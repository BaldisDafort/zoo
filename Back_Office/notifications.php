<?php
/**
 * Affiche une notification avec Toastify
 * @param string $message Le message à afficher
 * @param string $type Le type de notification (success, error, info)
 */
function showNotification($message, $type = 'info') {
    $typeClass = '';
    switch ($type) {
        case 'success':
            $typeClass = 'toastify-success';
            break;
        case 'error':
            $typeClass = 'toastify-error';
            break;
        default:
            $typeClass = 'toastify-info';
    }
    
    echo "<script>
        Toastify({
            text: '" . addslashes($message) . "',
            duration: 3000,
            gravity: 'top',
            position: 'right',
            className: '" . $typeClass . "',
            stopOnFocus: true
        }).showToast();
    </script>";
}
?> 