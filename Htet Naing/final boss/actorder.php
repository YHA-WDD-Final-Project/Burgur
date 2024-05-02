<?php
    include("dbcon.php");
    include("head.php");

?>
<?php
    if(isset($_GET['id']));
    $id=$_GET['id'];
?>


<style>
    input{
        border: none;
        outline: none;
    }
    #del{
        background-color: red;
        padding: 5px 10px;
        border-radius: 5px;
    }
</style>

<section>
    <div class="container">
        <div class="row">
        <table class="table">
                        <thead>
                            <tr>
                            
                            
                            <th scope="col">id</th>
                            <th>name</th>
                            <th>Catagory</th>
                            
                            <th>price</th>
                            <th scope="col" colspan="2" style="text-align:center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="" method="post" >
                            <?php 
                                $con = mysqli_connect("localhost","root","","finalboss");
                                $sql = "SELECT * FROM carttable WHERE user_id='$id'";
                                $res = mysqli_query($con ,$sql);
                                $x = 1;
                                while($row = mysqli_fetch_assoc($res)):
                            ?>
                            <tr>
                                <th><input type="text" name="u_id" value="<?php echo $row['user_id'];?>"></th>
                                <th scope="row"><input type="text" name="c_id" value="<?php echo $row['cart_id'];?>"></th>
                                <td><input type="disable" name="f_name[]" value="<?php echo $row['f_name'];?>"></td>
                                <td><input type="disable" name="m_name[]" value="<?php echo $row['m_name'];?>"></td>
                                
                                <td><input type="disable" name="m_oney[]" value="<?php echo $row['amount'];?>"></td>
                                
                                <td><input id="del" type="submit" style="margin-top:50px;" name="delete" value="Delete" ></td>
                            </tr>
                            <?php  
                                $x++;
                                endwhile;
                            ?>
                            <input type="submit" style="margin-top:50px;" name="buynow" value="Buy Now!" >
                        </form>
                        </tbody>
                    </table>
        </div>
    </div>
</section>

<?php
if (isset($_POST['buynow'])) {
    $uid = $_POST['u_id'];
    $fname = $_POST['f_name'];
    $mname = $_POST['m_name'];
    $money = $_POST['m_oney'];

    $con = mysqli_connect("localhost", "root", "", "finalboss");
    for ($i = 0; $i < count($fname); $i++) {
        $f_name = $con->real_escape_string($fname[$i]);
        $m_name = $con->real_escape_string($mname[$i]);
        $m_money = $con->real_escape_string($money[$i]);

        $sql = "INSERT INTO ordertable(user_id,item_name, cat_name, o_price) VALUES ('$uid','$f_name', '$m_name', '$m_money')";
        if (mysqli_query($con, $sql)) {
            echo "<script> altert('Order Complete!') </script>";
        } 
    }
    mysqli_close($con);
}
?>


<?php
    if(isset($_POST['delete'])){
        $c_id=$_POST['c_id'];

        $con=mysqli_connect("localhost","root","","finalboss");
        $sql="DELETE FROM carttable WHERE cart_id='$c_id'";

        mysqli_query($con,$sql);
        echo ("<script>alert('item is deleted')</script>");
        // header("Location:actorder.php");
       
    }
?>
