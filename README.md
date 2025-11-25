## Janji
Saya Firda Ridzki Utami dengan Nim 2401626 mengerjakan TP 9 dalam praktikum mata kuliah Desain Pemograman Berorientasi Objek (DPBO) untuk keberkahannya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan

## Alur dan penjelasna kode
Arsitektur MVP memisahkan aplikasi menjadi tiga lapisan utama: Model, View, dan Presenter.
- Model berfungsi sebagai mengelola data termasuk struktur class dan operasi database (CRUD).
- View hanya mengatur tampilan antarmuka
- Presenter berfungsi sebagai penghubung antara Model dan View

Pada fitur Pembalap, Model terdiri dari dua file: Pembalap.php yang mendefinisikan struktur data pembalap, dan TabelPembalap.php yang menangani query database seperti mengambil daftar pembalap, menambah, mengedit, atau menghapus data. Presenter (PresenterPembalap.php) menerima permintaan dari routing (index.php), kemudian meminta data dari Model dan meneruskannya ke View (ViewPembalap.php). View kemudian memproses hasil tersebut menjadi HTML di template skin.html dan form.html.

Fitur Circuit bekerja dengan pola yang sama. Circuit.php menjadi class data yang menyimpan atribut seperti nama circuit, lokasi, dan panjang lintasan. TabelCircuit.php menangani seluruh proses CRUD di tabel circuit. Presenter (PresenterCircuit.php) menjadi perantara yang mengatur alur kerja ketika user membuka halaman daftar circuit, menambah data, atau mengedit data. View (ViewCircuit.php) bertugas menampilkan hasil yang sudah dirangkai Presenter ke dalam file template skincircuit.html dan formcircuit.html.

semua alur aplikasi dikendalikan melalui index.php sebagai router utama. File ini menentukan presenter mana yang harus dijalankan berdasarkan parameter screen di URL. Misalnya, screen=pembalap memanggil PresenterPembalap, sedangkan screen=circuit memanggil PresenterCircuit.



## Dokumentasi
**Pembalap**



https://github.com/user-attachments/assets/c08bab8e-86c4-428b-b107-257bef530b31

<img width="1380" height="891" alt="Delete_Pembalap" src="https://github.com/user-attachments/assets/e59e92cc-890e-4337-91a8-3181c197aaa7" />

**Circuit**
<img width="945" height="410" alt="list_circuit" src="https://github.com/user-attachments/assets/2ff113af-e1fc-4a16-a2b4-6c746a3ce103" />

<img width="928" height="463" alt="Edit_Circuit" src="https://github.com/user-attachments/assets/2feec70c-2c4d-449d-be5a-057c258a7d32" />

<img width="1477" height="526" alt="delete" src="https://github.com/user-attachments/assets/47ba1638-b3e5-44d4-903e-cdcb10480fa9" />

