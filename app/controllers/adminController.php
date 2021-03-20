<?php

class adminController extends Controller
{
	private $account;
	private $admin;

	function init()
	{
		$this->user = new User($this);

		if (!$this->user->is_loggedin()) {
			App::redirect("login");
		}

		if ($this->session("role") != "Admin") {
			App::redirect("home");
		}

		$this->admin = new Admin($this);
	}

	function accounts()
	{
		$this->init();
		$this->view("admin/accounts.html", [
			"accounts" => $this->admin->get_accounts(),
		]);
	}

	function account($id = null)
	{
		$this->init();
		$page = "Create";
		if ($id) {
			$account = $this->admin->get_account($id);
			$page = "Edit";
			if ($this->post("submit")) {
				$this->admin->update_account(
					$id,
					$this->post("username"),
					$this->post("password"),
					$this->post("email"),
					$this->post("activation_code"),
					$this->post("rememberme"),
					$this->post("role")
				);
				App::redirect("admin");
			}
			if ($this->post("delete")) {
				$this->admin->delete_account($id);
				App::redirect("admin");
			}
		} else {
			$account = $this->admin->get_account();
			if ($this->post("submit")) {
				$this->admin->create_account(
					$this->post("username"),
					$this->post("password"),
					$this->post("email"),
					$this->post("activation_code"),
					$this->post("rememberme"),
					$this->post("role")
				);
				App::redirect("admin");
			}
		}
		$this->view("admin/account.html", [
			"account" => $account,
			"page" => $page,
			"roles" => ["Member", "Admin"],
		]);
	}

	function emailtemplate()
	{
		$this->init();
		if ($this->post("emailtemplate")) {
			file_put_contents(
				VIEWS_DIR .
					DIRECTORY_SEPARATOR .
					"activation-email-template.html",
				$this->post("emailtemplate")
			);
		}
		$contents = file_get_contents(
			VIEWS_DIR . DIRECTORY_SEPARATOR . "activation-email-template.html"
		);
		$this->view("admin/emailtemplate.html", [
			"contents" => $contents,
		]);
	}

	function settings()
	{
		$this->init();
		$config_file = file_get_contents(
			CONFIG_DIR . DIRECTORY_SEPARATOR . "settings.php"
		);
		preg_match_all('/define\(\'(.*?)\', ?(.*?)\)/', $config_file, $matches);
		if (!empty($this->post())) {
			foreach ($this->post() as $k => $v) {
				$v = in_array(strtolower($v), ["true", "false"])
					? strtolower($v)
					: '\'' . $v . '\'';
				$config_file = preg_replace(
					'/define\(\'' . $k . '\'\, ?(.*?)\)/s',
					'define(\'' . $k . '\',' . $v . ")",
					$config_file
				);
			}
			file_put_contents(
				CONFIG_DIR . DIRECTORY_SEPARATOR . "settings.php",
				$config_file
			);
			App::redirect("admin/settings");
		}
		$this->view("admin/settings.html", [
			"matches" => $matches,
		]);
	}
}
