<?php
//fetch.php
include('connection/connect.php');
$column = array("users.id", "users.office_id", "branch.name", "users.name");
$query = "
 SELECT * FROM users 
 INNER JOIN branch 
 ON branch.id = users.branch_id 
";
$query .= " WHERE ";
if(isset($_POST["is_branch"]))
{
 $query .= "users.branch_id = '".$_POST["is_branch"]."' AND ";
}
if(isset($_POST["search"]["value"]))
{
 $query .= '(users.id LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR users.office_id LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR branch.name LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR users.name LIKE "%'.$_POST["search"]["value"].'%") ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY users.id DESC ';
}

$query1 = '';

if($_POST["length"] != 1)
{
 $query1 .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($conn, $query));

$result = mysqli_query($conn, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = $row["office_id"];
 $sub_array[] = $row["name"];
 $sub_array[] = $row["name"];
 $data[] = $sub_array;
}

function get_all_data($conn)
{
 $query = "SELECT * FROM users";
 $result = mysqli_query($conn, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($conn),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>