<?php

class UserController extends Controller
{
    private $data;

    public function __construct()
    {
        $_searchInput = json_decode(file_get_contents("php://input"), true);
        $this->data = [
            'userType' => 'admin',
            'itemPerPageUSER'=> $_POST['number-rowsUSER']??'5',
            'pageUSER'=> $_POST['pageNumberUSER']??'1',
            'dateRange' => $_POST['date-range'] ?? 'Select Date Range',

            //Searchbar Axios
            'searchedData' => $_searchInput ?? null,
        ];
    }

    public function showAction()
    {

        if ($this->data['searchedData'] !== null) {
            // var_dump($this->data['searchedData']);
            $this->filterTableUSER($this->data);
            exit();
        }
        (isset($_GET['id'])) ? $this->viewUserProfile() : null;

        $user = new User();

        $this->data['user'] = $user->getAllUser(
            $this->data['searchedData'],
            $this->data['itemPerPageUSER'],   
            $this->data['pageUSER'], 
        );
        $this->data['numberofPagesUSER'] = $this->numberOfPages($this->data,'user');

        $this->render('admin/adminUsers', $this->data);
    }


    public function viewUserProfile()
    {
        $this->render('Layout/Components/userView', $this->data);
        exit();
    }
}
