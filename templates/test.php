Test page <br>
<?if (!$isAuthorised): ?>
	<form action="" method="post">
		<input type="text" name="login" placeholder="Login">
		<input type="password" name="pass" placeholder="Password">
		<input type="submit" name="Log">
	</form>
<?else:?>
	Привет, <?=$login?>
	<a href="/?page=test&logout">Logout</a>
<?endif;?>
<div style="height: 500px;"></div>
<div id="root">
<div class="container_horizontal div_flex">
    <div class="div_colwrap div_flex" v-if="user.name === ''">
        <div class="div_flex">
            <div :class="loginButtonClass(!logOrRegStatus)" @click="loginOrRegisterClickHandler(0)"><span>Log In</span></div>
            <div :class="loginButtonClass(logOrRegStatus)" @click="loginOrRegisterClickHandler(1)"><span>Register</span></div>
        </div>
        <label class="div_flex my_account__label">Username:<input class="choose__box" type="text" v-model="loginForm.Name" required></label>
        <label class="div_flex my_account__label">Password:<input class="choose__box" type="password" v-model="loginForm.Password" required></label>
        <template v-if="logOrRegStatus">
            <label class="div_flex my_account__label">E-mail:<input class="choose__box" type="email" v-model="registerForm.Mail" required></label>
            <label class="div_flex my_account__label">Age:<input class="choose__box" type="number" v-model="registerForm.Age" required></label>
        </template>
        <div class="button button_login div_flex" @click="logOrRegHandler">{{logOrReg}}</div>
    </div>
    <div v-else>
        <p class="footer__link">Username: {{user.name}}</p>
        <p class="footer__link">E-mail: {{user.mail}}</p>
        <p class="footer__link">Age: {{user.age}}</p>
        <div class="button button_login div_flex" @click="logoutClickHandler">Logout</div>
    </div>
</div>
</div>