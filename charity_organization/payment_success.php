<?php
include(__DIR__ . "/common/header.php");
if (isset($_POST['val_id'])) {
    $val_id = urlencode($_POST['val_id']);
    $store_id = urlencode("chari64c2771d21547");
    $store_passwd = urlencode("chari64c2771d21547@ssl");
    $requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=" . $val_id . "&store_id=" . $store_id . "&store_passwd=" . $store_passwd . "&v=1&format=json");

    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $requested_url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

    $result = curl_exec($handle);

    $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

    if ($code == 200 && !(curl_errno($handle))) {

        # TO CONVERT AS ARRAY
        # $result = json_decode($result, true);
        # $status = $result['status'];

        # TO CONVERT AS OBJECT
        $result = json_decode($result);

        # TRANSACTION INFO
        $status = $result->status;
        $tran_date = $result->tran_date;
        $tran_id = $result->tran_id;
        $val_id = $result->val_id;
        $amount = $result->amount;
        $store_amount = $result->store_amount;
        $bank_tran_id = $result->bank_tran_id;
        $card_type = $result->card_type;

        # EMI INFO
        $emi_instalment = $result->emi_instalment;
        $emi_amount = $result->emi_amount;
        $emi_description = $result->emi_description;
        $emi_issuer = $result->emi_issuer;

        # ISSUER INFO
        $card_no = $result->card_no;
        $card_issuer = $result->card_issuer;
        $card_brand = $result->card_brand;
        $card_issuer_country = $result->card_issuer_country;
        $card_issuer_country_code = $result->card_issuer_country_code;

        # API AUTHENTICATION
        $APIConnect = $result->APIConnect;
        $validated_on = $result->validated_on;
        $gw_version = $result->gw_version;
        $phone = $_GET["phone"];
        $email = $_GET["email"];
        $amount = $_GET["amount"];
        $event_id = $_GET["event_id"];

        $sql = "INSERT INTO donations(phone, amount, email, event_id) VALUES('$phone','$amount', '$email', '$event_id')";

        mysqli_query($conn, $sql);

        echo "<div class='container mt-5'>
            <div class='shadow text-center bg-success text-white rounded p-5'>
                <i class='fa-solid fa-circle-check fs-1'></i>
                <h5>Congratulations!!!</h5>
                <h5>
                Status: " . $status . "
                </h5>
                <h5>
                Transaction Date: " . $tran_date . "
                </h5>
                <h5>
                Donation Amount: " . $amount . "
                </h5>
            </div>
            </div>";
    } else {
        echo "<div class='container mt-5'>
            <div class='shadow text-center bg-danger text-white rounded p-5'>
            <i class='fa-solid fa-circle-xmark fs-1'></i>F
                <h5>
                Status: " . $status . "
                </h5>
            </div>
            </div>";
    }
} else {
    echo "<div class='container mt-5'>
            <div class='shadow text-center bg-danger text-white rounded p-5'>
            <i class='fa-solid fa-circle-xmark fs-1'></i>
                <h5>
                Payment Error occured
                </h5>
            </div>
            </div>";
}
?>

<?php include(__DIR__ . "/common/footer.php"); ?>