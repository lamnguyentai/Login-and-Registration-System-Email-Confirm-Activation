<?php include "includes/doctype.php"; ?>
        <title>新規登録</title>
<?php include "includes/header.php"; ?>
        

<?php include "includes/nav.php"; ?>
    <div class="container">
      
        <div class="row">
			<div class="col-md-5 mx-auto">
			      <div class="myform form mt-4">
                        <div class="logo mb-3">
                           <div class="col-md-12 text-center">
                              <h2>Sign up</h2>
                           </div>
                        </div>
                        <form action="#" name="registration" novalidate="novalidate">
                           <div class="form-group">
                              <label for="registration">氏名</label>
                              <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="氏名を入力">
                           </div>
                           <div class="form-group">
                              <label for="registration">メールアドレスアドレス</label>
                              <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="メールアドレスを入力">
                           </div>
                           <div class="form-group">
                              <label for="registration">パスワード</label>
                              <input type="password" name="password" id="password" class="form-control" aria-describedby="emailHelp" placeholder="パスワードを入力"　onChange=onchange();>
                           </div>
                           <div class="form-group">
                              <label for="registration">再確認のパスワード</label>
                              <input type="password" name="confirm_password" id="confirm-password" class="form-control" aria-describedby="emailHelp" placeholder="再確認のパスワードを入力" onChange=onchange();>
                           </div>
                           <div class="col-md-12 text-center mb-3">
                              <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">新規登録</button>
                           </div>
                           <div class="col-md-12 ">
                              <div class="form-group">
                                 <p class="text-center"><a href="login.php" id="signin">アカウントをお持ち方ですか</a></p>
                              </div>
                           </div>
                            </form></div>
                   
			</div>
		</div>
      </div>   
         
	<script type="text/javascript">
$(function() {
  
  $("form[name='registration']").validate({
    rules: {
      firstname: "required",
      lastname: "required",
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 6
      },
    },
    
    messages: {
      name: "氏名を入力してください",
      password: {
        required: "パスワードを入力してください",
        minlength: "パスワードの長さは６文字以上を入力してください"
      },
      confirm_password: {
         required: "再確認のパスワードを入力してください"
      },
      email: "メールのパターンを正しく入力してください"
    },
  
    submitHandler: function(form) {
      form.submit();
    }
  });
});
    </script>
    </body>
    </html>
