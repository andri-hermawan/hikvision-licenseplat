const http = require('http'); // Membuat obyek http

const hostname = '192.168.0.102'; // Menyatakan hostname
const port = 3000; // //Menyatakan port yang dipakai

// Membuat server
// req adalah request yang akan diproses, dalam hal ini tidak ada yang diproses
// res adalah respon yang diberikan kembali ke client
const server = http.createServer((req, res) => {
res.statusCode = 200; // menyatakan web tersedia, pelajari lebih lanjut tentang HTTP response code
res.setHeader('Content-Type', 'text/plain'); // set tipe konten pada Header
res.end('Halo Dunia\n'); // konten
});

// Menjalankan server pada hostname dengan port yang telah ditentukan
server.listen(port, hostname, () => {
// Pesan yang dikirimkan ke client oleh server pada console.log
// Pesan dapat dilihat pada console melalui inspect element (klik kanan) di browser
console.log(`Server berjalan di http://${hostname}:${port}/`);
});