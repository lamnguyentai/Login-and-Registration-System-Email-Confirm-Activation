<?php include "includes/doctype.php"; ?>
        <title>ログイン</title>
<?php include "includes/header.php"; ?>



<?php include "includes/nav.php"; ?>
    <div class="container">
      
      
        <div class="row">
			<div class="col-md-5 mx-auto">
				<div class="myform form mt-4">
					 <div class="logo mb-3">
						 <div class="col-md-12 text-center">
							<h1>Login</h1>
						 </div>
					</div>
                   <form action="" method="post" name="login" novalidate="novalidate">
                           <div class="form-group">
                              <label for="login">メールアドレス</label>
                              <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="メールアドレスを入力">
                           </div>
                           <div class="form-group">
                              <label for="login">パスワード</label>
                              <input type="password" name="password" id="password" class="form-control" aria-describedby="emailHelp" placeholder="パスワードを入力">
                           </div>
                           <div class="form-group form-check mb-3 text-center">
                            <input class="form-check-input" type="checkbox" value="remember-me" id="rememberCheck">
                            <label class="form-check-label" for="rememberCheck">
                              状態を記憶する
                            </label>
                          </div>
                           <div class="col-md-12 text-center ">
                              <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">ログイン</button>
                           </div>
                           <div class="col-md-12 ">
                              <div class="login-or">
                                 <hr class="hr-or">
                                 <span class="span-or">or</span>
                              </div>
                           </div>
                           <div class="col-md-12 mb-3">
                              <p class="text-center">
                                 <a href="javascript:void();" class="google btn mybtn b"><i class="fa fa-google-plus" style="color: red;">
                                 </i> Googleアカウントでログイン
                                 </a>
                              </p>
                           </div>
                           <div class="form-group">
                              <p class="text-center"><a href="recover.php">パスワードを忘れた方</a>または<a href="register.php">新規登録</a></p>
                           </div>
      
                        </form>
                 
				</div>
			  
                        
                     </div>
			</div>
		</div>
      </div>   
         
	<script type="text/javascript">
	


  
         $(function() {
           $("form[name='login']").validate({
             rules: {
               
               email: {
                 required: true,
                 email: true
               },
               password: {
                 required: true,
                 
               }
             },
              messages: {
               email: "メールのパターンを正しく入力してください",
              
               password: {
                 required: "パスワードを入力してください",
                
               }
               
             },
             submitHandler: function(form) {
               form.submit();
             }
           });
         });
    </script>
    </body>
    </html>
