<div align="center">

  <img src="https://github.com/Azmi2511/atlas-web/blob/main/public/images/logo.png" alt="EduFace Logo" width="120">

  # 🏢 EduFace
  ### Digital Attendance System for Modern Productivity

  [![Laravel 13](https://img.shields.io/badge/Framework-Laravel%2013-red.svg?style=for-the-badge&logo=laravel)](https://laravel.com)
  [![PHP 8.3](https://img.shields.io/badge/PHP-8.3-blue.svg?style=for-the-badge&logo=php)](https://php.net)
  [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](https://opensource.org/licenses/MIT)
  [![Status](https://img.shields.io/badge/Status-Development-orange.svg?style=for-the-badge)]()

  **EduFace** adalah platform absensi digital cerdas yang menggabungkan presisi **Face Recognition**, keamanan **Dynamic QR Code**, dan akurasi **Geofencing**. 
  Dibuat untuk memastikan kehadiran yang real-time dan bebas manipulasi.

  [Jelajahi Fitur](#-fitur-unggulan) • [Instalasi](#-memulai-instalasi) • [Dokumentasi](#-dokumentasi-api) • [Kontribusi](#-kontribusi)

</div>

---

## ✨ Fitur Unggulan

Sistem ini dibangun dengan fokus pada keamanan dan kemudahan penggunaan:

*   **🛡️ Multi-Factor Auth** – Keamanan tingkat tinggi dengan Laravel Breeze & Sanctum.
*   **📸 Face Recognition** – Verifikasi biometrik wajah untuk validasi identitas asli.
*   **📍 GPS Geofencing** – Pembatasan radius absensi berdasarkan lokasi (Kampus/Kantor).
*   **🔄 Dynamic QR Code** – QR Code yang berubah otomatis via **Laravel Reverb** (Anti-photo manipulation).
*   **📊 Real-time Dashboard** – Pantau kehadiran secara langsung tanpa perlu *refresh* halaman.
*   **📜 Professional Reporting** – Ekspor laporan instan ke format **Excel** (Maatwebsite) atau **PDF** (DomPDF).

---

## 🛠️ Tech Stack

### Core Engine
| Component | Technology |
| :--- | :--- |
| **Backend** | Laravel 13 & PHP 8.3 |
| **Database** | MySQL |
| **Real-time** | Laravel Reverb (WebSockets) |
| **Security** | Laravel Sanctum & Spatie Permission |

### Frontend & Experience
*   **UI Framework:** Tailwind CSS
*   **Reactive Logic:** Livewire / Inertia.js
*   **Documentation:** Scramble (Automatic API Docs)
*   **Monitoring:** Laravel Telescope & Pail

---

## 🚀 Memulai Instalasi

Pastikan lingkungan pengembangan Anda memenuhi syarat: **PHP >= 8.3**, **Composer**, dan **Node.js**.

### 1. Kloning Repositori
```bash
git clone https://github.com/username/eduface.git
cd eduface.
```
### 2. Setup Otomatis
Kami telah menyediakan skrip automasi untuk mempercepat konfigurasi (.env, key, migrate, dll):

```bash
composer run setup
```

### 3. Menjalankan Server
Gunakan perintah satu pintu untuk menjalankan Server, Vite, Queue, dan Reverb sekaligus:

```bash
composer run dev
```
Aplikasi akan berjalan di: http://localhost:8000

## 📖 Dokumentasi API
EduFace menggunakan Scramble untuk men-generate dokumentasi API secara otomatis. Anda tidak perlu menulis manual, cukup akses:

👉 http://localhost:8000/docs/api

## 🤝 Kontribusi
Jika Anda ingin berkontribusi pada EduFace, silakan lakukan fork dan buat pull request, atau buka issue untuk diskusi fitur baru.

1. Fork Project

2. Create Feature Branch (git checkout -b feature/FiturKeren)

3. Commit Changes (git commit -m 'Menambah fitur keren')

4. Push to Branch (git push origin feature/FiturKeren)

5. Open Pull Request

## 👨‍💻 Developed By
Zul Azmi

_Fullstack Developer_