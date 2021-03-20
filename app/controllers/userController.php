<?php

class userController extends Controller
{
	private $user;

	function init()
	{
		$this->user = new User($this);
	}

	function login()
	{
		if ($this->user->is_loggedin()) {
			App::redirect("home");
		}

		$this->session("token", md5(uniqid(rand(), true)));

		$this->view("login.html", [
			"token" => $this->session("token"),
		]);
	}

	function authenticate()
	{
		return $this->user->authenticate(
			$this->post("username"),
			$this->post("password"),
			$this->post("rememberme"),
			$this->session("token")
		);
	}

	function register()
	{
		if ($this->user->is_loggedin()) {
			App::redirect("home");
		}
		$this->view("register.html");
	}

	function register_process()
	{
		return $this->user->register(
			$this->post("username"),
			$this->post("password"),
			$this->post("cpassword"),
			$this->post("email")
		);
	}

	function home()
	{
		if (!$this->user->is_loggedin()) {
			App::redirect("login");
		}

		$this->view("home.html", [
			"role" => $this->session("role"),
			"name" => $this->session("name"),
		]);
	}

	function profile()
	{
		if (!$this->user->is_loggedin()) {
			App::redirect("login");
		}

		$this->view("profile.html", [
			"role" => $this->session("role"),
			"account" => $this->user,
		]);
	}

	function profile_edit()
	{
		if (!$this->user->is_loggedin()) {
			App::redirect("login");
		}
		$msg = "";
		if ($this->post("save")) {
			$msg = $this->user->update_info(
				$this->post("username"),
				$this->post("password"),
				$this->post("cpassword"),
				$this->post("email")
			);
			if ($msg == "Success") {
				App::redirect("profile");
			}
		}
		$this->view("edit-profile.html", [
			"role" => $this->session("role"),
			"account" => $this->user,
			"msg" => $msg,
		]);
	}

	function activate($email, $code)
	{
		if ($this->user->is_loggedin()) {
			App::redirect("home");
		}
		if (!empty($email) && !empty($code)) {
			$activated = $this->user->activate($email, $code);
			$this->view("activate.html", [
				"activated" => $activated,
			]);
		}
	}

	function forgot_password()
	{
		if ($this->user->is_loggedin()) {
			App::redirect("home");
		}
		$msg = "";
		if ($this->post("email")) {
			$msg = $this->user->forgot_password($this->post("email"));
		}
		$this->view("forgot-password.html", [
			"msg" => $msg,
		]);
	}

	function reset_password($email, $code)
	{
		if ($this->user->is_loggedin()) {
			App::redirect("home");
		}
		if ($email && $code) {
			$msg = "";
			if ($this->post("npassword") && $this->post("cpassword")) {
				$msg = $this->user->reset_password(
					$email,
					$code,
					$this->post("npassword"),
					$this->post("cpassword")
				);
			}
			$this->view("reset-password.html", [
				"msg" => $msg,
				"email" => $email,
				"code" => $code,
			]);
		}
	}

	function resend_activation()
	{
		if ($this->user->is_loggedin()) {
			App::redirect("home");
		}
		$msg = "";
		if ($this->post("email")) {
			$msg = $this->user->resend_activation($this->post("email"));
		}
		$this->view("resend-activation.html", [
			"msg" => $msg,
		]);
	}

	function logout()
	{
		session_start();
		session_destroy();

		if (isset($_COOKIE["rememberme"])) {
			unset($_COOKIE["rememberme"]);
			setcookie("rememberme", "", time() - 3600);
		}
		App::redirect("login");
	}
}
