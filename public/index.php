<?php

require_once __DIR__ . "/../vendor/autoload.php";

session_start();

use Krispachi\KrisnaLTE\App\Router;
use Krispachi\KrisnaLTE\Controller\MainController;
use Krispachi\KrisnaLTE\Controller\AuthController;
use Krispachi\KrisnaLTE\Controller\IzinController;
use Krispachi\KrisnaLTE\Middleware\AuthMiddleware;
use Krispachi\KrisnaLTE\Middleware\GuestMiddleware;
use Krispachi\KrisnaLTE\Controller\SubjectController;
use Krispachi\KrisnaLTE\Controller\MahasiswaController;
use Krispachi\KrisnaLTE\Controller\MajorController;
use Krispachi\KrisnaLTE\Controller\KelasController;
use Krispachi\KrisnaLTE\Controller\UserController;
use Krispachi\KrisnaLTE\Controller\PengajuanController;
use Krispachi\KrisnaLTE\Middleware\AdminMiddleware;
use Krispachi\KrisnaLTE\Middleware\PetugasPendaftaranMiddleware;


Router::add("GET", "/login", AuthController::class, "index", [GuestMiddleware::class]);
Router::add("POST", "/login", AuthController::class, "signin", [GuestMiddleware::class]);
Router::add("GET", "/register", AuthController::class, "register", [GuestMiddleware::class]);
Router::add("POST", "/register", AuthController::class, "signup", [GuestMiddleware::class]);
Router::add("POST", "/register2", UserController::class, "addUser", [AuthMiddleware::class, AdminMiddleware::class]);
Router::add("GET", "/forgot-password", AuthController::class, "forgotPassword", [GuestMiddleware::class]);
Router::add("GET", "/logout", AuthController::class, "logout", [AuthMiddleware::class]);
Router::add("POST", "/changePassword/([0-9a-zA-Z]*)", AuthController::class, "change", [AuthMiddleware::class]);
Router::add("POST", "/changePhoto/([0-9a-zA-Z]*)", AuthController::class, "changePhoto", [AuthMiddleware::class]);


Router::add("GET", "/", MainController::class, "index2", [GuestMiddleware::class]);
Router::add("GET", "/mahasiswas", MahasiswaController::class, "index", [AuthMiddleware::class]);
Router::add("GET", "/mahasiswas/create", MahasiswaController::class, "create", [AuthMiddleware::class, PetugasPendaftaranMiddleware::class]);
Router::add("POST", "/mahasiswas/create", MahasiswaController::class, "store", [AuthMiddleware::class, PetugasPendaftaranMiddleware::class]);
Router::add("GET", "/mahasiswas/update/([0-9a-zA-Z]*)", MahasiswaController::class, "update", [AuthMiddleware::class, PetugasPendaftaranMiddleware::class]);
Router::add("POST", "/mahasiswas/update/([0-9a-zA-Z]*)", MahasiswaController::class, "edit", [AuthMiddleware::class, PetugasPendaftaranMiddleware::class]);
Router::add("POST", "/mahasiswas/delete/([0-9a-zA-Z]*)", MahasiswaController::class, "delete", [AuthMiddleware::class, PetugasPendaftaranMiddleware::class]);

Router::add("GET", "/users", AuthController::class, "profile", [AuthMiddleware::class]);
Router::add("POST", "/users/update/([0-9a-zA-Z]*)", AuthController::class, "edit", [AuthMiddleware::class]);
Router::add("POST", "/users/delete/([0-9a-zA-Z]*)", AuthController::class, "delete", [AuthMiddleware::class]);
Router::add("POST", "/users/edit", UserController::class, "editbyadmin", [AuthMiddleware::class]);

Router::add("GET", "/subjects", SubjectController::class, "index", [AuthMiddleware::class, AdminMiddleware::class]);
Router::add("POST", "/subjects", SubjectController::class, "store", [AuthMiddleware::class, AdminMiddleware::class]);
Router::add("GET", "/subjects/([0-9a-zA-Z]*)", SubjectController::class, "subject", [AuthMiddleware::class, AdminMiddleware::class]);
Router::add("POST", "/subjects/([0-9a-zA-Z]*)", SubjectController::class, "edit", [AuthMiddleware::class, AdminMiddleware::class]);
Router::add("POST", "/subjects/delete/([0-9a-zA-Z]*)", SubjectController::class, "delete", [AuthMiddleware::class, AdminMiddleware::class]);

Router::add("GET", "/majors", MajorController::class, "index", [AuthMiddleware::class, AdminMiddleware::class]);
Router::add("POST", "/majors", MajorController::class, "store", [AuthMiddleware::class, AdminMiddleware::class]);
Router::add("GET", "/majors/([0-9a-zA-Z]*)", MajorController::class, "major", [AuthMiddleware::class, AdminMiddleware::class]);
Router::add("POST", "/majors/delete/([0-9a-zA-Z]*)", MajorController::class, "delete", [AuthMiddleware::class, AdminMiddleware::class]);
Router::add("POST", "/majors/([0-9a-zA-Z]*)", MajorController::class, "edit", [AuthMiddleware::class, AdminMiddleware::class]);

Router::add("GET", "/kelas", KelasController::class, "index", [AuthMiddleware::class, AdminMiddleware::class]);
Router::add("POST", "/Createkelas", KelasController::class, "create", [AuthMiddleware::class, AdminMiddleware::class]);
Router::add("POST", "/kelas/delete", KelasController::class, "delete", [AuthMiddleware::class, AdminMiddleware::class]);
Router::add("POST", "/kelas/update", KelasController::class, "edit", [AuthMiddleware::class, AdminMiddleware::class]);


Router::add("GET", "/izin", IzinController::class, "index", [AuthMiddleware::class]);
Router::add("GET", "/izin2", IzinController::class, "index2", [AuthMiddleware::class]);
Router::add("GET", "/dashboard", MainController::class, "index", [AuthMiddleware::class]);
Router::add("POST", "/izin/process-approval", IzinController::class, "processApproval");
Router::add("POST", "/izin/process-approval2", IzinController::class, "processApproval2");
Router::add("POST", "/izin/create", IzinController::class, "create");
Router::add("POST", "/izin/create2", IzinController::class, "create2");
Router::add("POST", "/izin/edit", IzinController::class, "edit");
Router::add("POST", "/izin/delete/([0-9a-zA-Z]*)", IzinController::class, "delete", [AuthMiddleware::class]);
Router::add("POST", "/izin2/edit", IzinController::class, "edit2");
Router::add("POST", "/izin2/delete/([0-9a-zA-Z]*)", IzinController::class, "delete2", [AuthMiddleware::class]);


Router::add("GET", "/user", UserController::class, "index", [AuthMiddleware::class, AdminMiddleware::class]);

Router::add("GET", "/pengajuan", PengajuanController::class, "index", [AuthMiddleware::class]);
Router::add("GET", "/pengajuan/create/([0-9a-zA-Z]*)", PengajuanController::class, "gotoCreate", [AuthMiddleware::class]);
Router::add("POST", "/mahasiswa-pengajuan/create", PengajuanController::class, "store", [AuthMiddleware::class]);
Router::add("GET", "/pengajuan/update/([0-9a-zA-Z]*)", PengajuanController::class, "update", [AuthMiddleware::class]);
Router::add("POST", "/mahasiswa-pengajuan/update/([0-9a-zA-Z]*)", PengajuanController::class, "edit", [AuthMiddleware::class]);
Router::add("POST", "/pengajuan/delete/([0-9a-zA-Z]*)", PengajuanController::class, "delete", [AuthMiddleware::class]);
Router::add("POST", "/pengajuan/approve/([0-9a-zA-Z]*)", PengajuanController::class, "approve", [AuthMiddleware::class]);


Router::add("GET", "/tentang", MainController::class, "tentang", [GuestMiddleware::class]);
Router::add("GET", "/tentang2", MainController::class, "tentang2", [GuestMiddleware::class]);
Router::add("GET", "/faq", MainController::class, "faq", [GuestMiddleware::class]);
Router::add("POST", "/print", MainController::class, "print", [AuthMiddleware::class]);
Router::add("GET", "/keluar", MainController::class, "keluar", [AuthMiddleware::class]);
Router::add("GET", "/cuti", MainController::class, "cuti", [AuthMiddleware::class]);
Router::add("GET", "/berita", MainController::class, "berita", [AuthMiddleware::class]);
Router::add("POST", "/berita/edit", MainController::class, "editberita", [AuthMiddleware::class]);


Router::add("GET", "/panduanAplikasi", MainController::class, "panduan", [AuthMiddleware::class]);
Router::run();
?>