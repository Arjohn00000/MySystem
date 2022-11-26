addproduct
$('#btnAddproduct').click(function(){
    add();
});

var add =()=>{
    if ($('#product_name').val() != "" && $('#product_price').val() != "") {
        addproduct();
    }else{
        alert("Please fill-in empty field(s)");
    }
}

var addproduct =()=>{
    $.ajax({
        type: "POST",
        url: "./router.php",
        data: {choice:'add',product_name:$('#product_name').val(),product_price:$('#product_price').val()},
        success: function(data){
            if (data == "200") {
                window.location.href = "./dashboard.html";
            }
        }, 
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
}

//view product
$(document).ready(function(){
    let tmp = localStorage.getItem('isloggedin');
    if (tmp == 404) {
        window.location.href = "./dashboard.html";
    }
    view();  
});





case 'add':
            $backend = new backend();
            echo $backend->doAddProduct($_POST['product_name'],$_POST['product_price']);
            break;
        case 'view':
            $backend = new backend();
            echo $backend->doViewProduct();
            break;




            private function addProduct($pname,$pprice){
            try {
                $tmp_u = $_SESSION['user'];
                $tmp_p = $_SESSION['pass'];
                if ($this->checkIfVallid($tmp_u, $tmp_p)) {
                    $db = new database();
                    if ($db->getStatus()) {
                        $stmt = $db->getCon()->prepare($this->addProductQuery());
                        $stmt->execute(array($this->getId(),$pname,$pprice,$this->getCurrentDate()));
                        $result = $stmt->fetch();
                        if (!$result) {
                            $db->closeConnection();
                            return "501";
                        }else{
                            $db->closeConnection();
                            return "404";
                        }
                    }else{
                        return "403";
                    }
                } else {
                    return "403";
                }
            } catch (PDOException $th) {
                return "200";
            }
    }

    private function getProduct(){
        try {
            if ($this->checkIfVallid($_SESSION['user'], $_SESSION['pass'])) {
                $db = new database();
                if ($db->getStatus()) {
                    $stmt = $db->getCon()->prepare($this->getProductQuery());
                    $stmt->execute(array($this->getId()));
                    $result = $stmt->fetchAll();
                    $db->closeConnection();
                    return json_encode($result);
                }else{
                    return "403";
                }
            } else {
                return "403";
            }
        } catch (PDOException $th) {
            return "501";
        }
    }

    private function getId(){
        try {
            $db = new database();
            if ($db->getStatus()) {
                $stmt = $db->getCon()->prepare($this->loginQuery());
                $stmt->execute(array($_SESSION['user'],$_SESSION['pass']));
                $tmp = null;
                while ($row = $stmt->fetch()) {
                    $tmp = $row['id'];
                }
                $db->closeConnection();
                return $tmp;
            }
        } catch (PDOException $th) {
            echo $th;
        }        
    }

    private function getCurrentDate(){
        return date("Y/m/d");
    }





    private function addProductQuery(){
        return "INSERT INTO `product`(`user_id`, `product_name`, `product_price`, `created`) 
                VALUES (?,?,?,?)";
    }

    private function getProductQuery()
    {
        return "SELECT * FROM product WHERE user_id = ?";
    }



    var view =()=>{
    $.ajax({
        type: "POST",
        url: "./router.php",
        data: {choice:'view'},
        success: function(data){
            var json = JSON.parse(data);
            var str = "";
            let ctr = 1;
            json.forEach(element => {
                str += "<tr>";
                str += "<td>"+ctr+"</td>";
                str += "<td>"+element.product_name+"</td>";
                str += "<td>"+element.product_price+"</td>";
                str += "<td>"+element.created+"</td>";
                str += "</tr>";
                ctr++;
            });
            $('#table').append(str);
        }, 
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
}

var logout =()=>{
    $.ajax({
        type: "POST",
        url: "./router.php",
        data: {choice:'logout'},
        success: function(data){
            if (data == "200") {
                localStorage.setItem('isloggedin','404');
                window.location.href = "./register.html";
            }
        }, 
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
}

public function doAddProduct($pname,$pprice){
        return self::addProduct($pname,$pprice);
    }
    public function doViewProduct(){
        return self::getProduct();
    }