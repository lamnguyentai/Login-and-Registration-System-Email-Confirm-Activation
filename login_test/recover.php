<?php include "includes/doctype.php"; ?>
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>パスワードをリセット</title>
<?php include "includes/header1.php"; ?>

    
<?php include "includes/nav.php"; ?>
<body>
<div class="gap p-3"></div>

<?php display_message(); ?>
<?php recover_password(); ?>
    

<div class="container text-center">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="myform form mt-5">       
                          <h3><i class="fa fa-lock fa-5x"></i></h3>
                          <h2 class="text-center">Forgot Password?</h2>
                          <p>登録したパスワードを入力してください</p> 
                              <form class="form" name="recover" method="post">
                              <div class="form-group">
                              <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="メールアドレスを入力">
                              </div>
                                <div class="text-center">
                              <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm" name="recover_submit">パスワードをリセットする</button>
                                </div>
                                <input type="hidden" class="hide" name="token" id="token" value="<?php echo token_generator(); ?>">
                              </form> 
                </div>
            </div>
        </div>
</div>
</div>
<script type="text/javascript">
         $(function() {
           $("form[name='recover']").validate({
             rules: {
               email: {
                 required: true,
                 email: true
               },
             },

              messages: {
               email: "メールのパターンを正しく入力してください",
               required: "メールアドレスを入力してください"
             },
             submitHandler: function(form) {
               form.submit();
             }
           });
         });
    </script>

<?php include "includes/footer.php"; ?>