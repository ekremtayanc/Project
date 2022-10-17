<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Proje Hakkında

### Proje Gereksimimleri
- PHP v8.0
- MySql 8.0

### Proje Kurulumu
- Projeyi Repository Clone işleminden sonra uygulama konunumunu terminal üzerinden açın.
- ``` composer update ``` komutu ile gerekli paketleri indirin.
- Terminal üzerinden linux veya mac kullanıyorsanız ```cp .env.example .env ``` komutunu kullanabilirsiniz.
- Windows kullanıyorsanız ```copy .env.example .env ``` komutu ile environment dosyasını oluşturun.
- Terminal üzerinde ```php artisan key:generate``` komutunu kullanarak laravel projesi için yeni bir APP_KEY oluşturun.
- Mysql üzerinde bir database oluşturun.
- ```.env``` dosyası üzerinde,oluşturulan database bağlantı bilgilerini ilgili alanlara girin yapın.
- Proje klasörü içinde bulunan ```project.sql``` dump dosyasını oluturulan database içine import edin. 
- Yada terminal üzerinden ```php artisan migrate``` komutu ile mevcut migration tablelarını yükleyebilirsiniz.
- Terminal üzerinde ```php artisan tinker``` komutu ile tinker modülüne geçip, ```Student::factory()->count(1000)->create()```
komutunu kullanarak factory üzerinden dummy datalar oluşturabilirsiniz.
- Database bağlantılarını gerçekleştirdikten sonra ```php artisan serve``` komutu ile projeyi çalıştırabilirsiniz.
