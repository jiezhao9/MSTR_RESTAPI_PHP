# MicroStrategy_RESTful_PHP
PHP code snippets that exchanging data with MicroStrategy Restful API Server

// Sample 1: Create I-Server session
// Method: POST
// Endpoint: /api/sessions
create_session('administrator','');

// Sample 2: Create a folder under shared folder
// Method: POST
// Endpoint: /api/folders
create_folder('description','folder_name','D3C7D461F69C4610AA6BAA5EF51F4125',$sessionid);

// Sample 3: delete an object
// Method: DELETE
// Endpoint: /api/objects/{id}
delete_object('DEDA32E64D0529A17A2257A7BB8FE154',$sessionid);


// Sample 4: Export dashboard
// Method: GET
// Endpoint: /api/dashboards/{id}
execute_dashboard('233AE5EF48F48E84B4626D8E0E8806DE',$sessionid);
