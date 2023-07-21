<?php
/**
 *
 * check database connection
 * */
if (isset($_POST['action']) && $_POST['action'] === '_install_script') {
    $installation_path = $_POST['installation_path'];
    $db_name = $_POST['db_name'];
    $db_username = $_POST['db_username'];
    $db_host = $_POST['db_host'];
    $db_password = $_POST['db_password'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $admin_username = $_POST['admin_username'];
    $admin_name = $_POST['admin_name'];

    try {
        $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $import_database = importDatabase($db);

        $env_update_status = systemInstall([
            'database_host' => $db_host,
            'database_name' => $db_name,
            'database_username' => $db_username,
            'database_password' => $db_password
        ]);

        $admin_update_status = setAdminDetails([
            'database_host' => $db_host,
            'database_name' => $db_name,
            'database_username' => $db_username,
            'database_password' => $db_password
        ],[
            'admin_email' => $admin_email,
            'admin_username' => $admin_username,
            'admin_password' => $admin_password,
            'admin_name' => $admin_name,
        ]);


        echo json_encode([
            [
                'type' => $import_database ? 'success' : 'danger',
                'msg' =>  $import_database ? 'Database Imported Successfully' : 'Database Import Failed'
            ],
            [
                'type' => $env_update_status ? 'success' : 'danger',
                'msg' => $env_update_status ? 'System Information Updated Succssfully' : 'System Information Update Failed'
            ],
            [
                'type' => $admin_update_status ? 'success' : 'danger',
                'msg' => $admin_update_status ? 'Admin Credentials Updated Successfully' : 'Admin Credentials Update Failed'
            ],
            [
                'type' => $admin_update_status && $env_update_status && $import_database ? 'success' : 'danger',
                'msg' => $admin_update_status && $env_update_status && $import_database ? 'Insallation Succssfull, if you still see install notice in your website, clear your browser cache '.'<a href="'.$installation_path.'">visit website</a>' : 'Installation Failed'
            ]
        ]);

    } catch (PDOException $e) {
        echo json_encode([
            [
                'type' => 'danger',
                'msg' => $e->getMessage()
            ]
        ]);
    }

}
/* system info update */
function systemInstall($db_details)
{
    $status = false;

    if (file_exists('env-sample.txt')) {
        $str = file_get_contents('env-sample.txt');
        $str = str_replace(array(
            'YOUR_APP_URL',
            'YOUR_DATABASE_HOST',
            'YOUR_DATABASE_NAME',
            'YOUR_DATABASE_USERNAME',
            'YOUR_DATABASE_PASSWORD'
        ),array(
            'localhost',
            $db_details['database_host'],
            $db_details['database_name'],
            $db_details['database_username'],
            '"' . $db_details['database_password'] . '"'
        ), $str);

        if (file_put_contents('../@core/.env', $str) != false) {
            $status = true;
        }
    }

    return $status;
}


function setAdminDetails($db,$admin_details)
{

    $db_name = $db['database_name'];
    $db_username = $db['database_username'];
    $db_host = $db['database_host'];
    $db_password = $db['database_password'];

    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    /*----------------------------------------------------
       PREPARE SQL QUERY USING PDO FOR CREATE NEW ADMIN
    ----------------------------------------------------*/
    $create_admin =  $db->prepare("INSERT INTO `admins` (name,email,username,email_verified,role,image,password,remember_token,created_at,updated_at) VALUES (:name,:email,:username,:verified,:role,:image,:password,:token,:created,:updated)");

    /*----------------------------------------------
        ADD NEW SUPER ADMIN WHILE INSTALLATION
    ----------------------------------------------*/
    $create_admin->execute([
        ':name' => strip_tags(trim($admin_details['admin_name'])),
        ':email' => trim($admin_details['admin_email']),
        ':username' => strip_tags(trim($admin_details['admin_username'])),
        ':verified' => 1,
        ':password' => password_hash($admin_details['admin_password'], PASSWORD_BCRYPT),
        ':role' => 1,
        ':image' => null,
        ':token' => null,
        ':created' => date('Y-m-d h:i:s'),
        ':updated' => date('Y-m-d h:i:s'),

    ]);
    $last_insert_id = $db->lastInsertId();
    /*--------------------------------------------------------
       PREAPARE SLQ QUERY FOR ASSIGN SUPER ADMIN ROLE
    --------------------------------------------------------*/
    $role_assign = $db->prepare("INSERT INTO `model_has_roles` (role_id,model_type,model_id) VALUES (:role_id,:model,:model_id)");
    /*--------------------------------------------------------
        ASSIGN SUPER ADMIN ROLE FOR CREATED ADMIN
    --------------------------------------------------------*/
    $role_assign->execute([
        ':role_id' => '1',
        ':model' => 'App\Admin',
        ':model_id' => $last_insert_id,
    ]);
    return true;
}


/* import database */
function importDatabase($db)
{
    if (file_exists("database.sql")){
        $query = file_get_contents("database.sql");
        $stmt = $db->prepare($query);
        return (bool)$stmt->execute();
    }
    return false;
}




/* check database connection */
if (isset($_POST['action']) && $_POST['action'] === '_db_connection_check') {
    $db_name = $_POST['db_name'];
    $db_username = $_POST['db_username'];
    $db_host = $_POST['db_host'];
    $db_password = $_POST['db_password'];
    try {
        $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo json_encode([
            'type' => 'success',
            'msg' => 'Database Connected Successfully'
        ]);

    } catch (PDOException $e) {
        echo json_encode([
            'type' => 'danger',
            'msg' => $e->getMessage()
        ]);
    }
}

die();