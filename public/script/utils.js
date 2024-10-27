const formatPrice = function (price) {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
        maximumFractionDigits: 0,
    }).format(price);
};

function truncateText(text, wordLimit) {
    const words = text.split(" ");
    if (words.length > wordLimit) {
        return words.slice(0, wordLimit).join(" ") + "...";
    }
    return text;
}

function timeAgo(dateString) {
    const now = new Date();
    const date = new Date(dateString);
    const seconds = Math.floor((now - date) / 1000);

    let interval = Math.floor(seconds / 31536000); // tahun
    if (interval > 1) return `${interval} tahun`;
    interval = Math.floor(seconds / 2592000); // bulan
    if (interval > 1) return `${interval} bulan`;
    interval = Math.floor(seconds / 86400); // hari
    if (interval > 1) return `${interval} hari`;
    interval = Math.floor(seconds / 3600); // jam
    if (interval > 1) return `${interval} jam`;
    interval = Math.floor(seconds / 60); // menit
    if (interval > 1) return `${interval} menit`;
    return `${seconds} detik`;
}

function formatDate(dateString) {
    const months = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    // Mengonversi string menjadi objek Date
    const date = new Date(dateString);

    // Mendapatkan komponen tanggal
    const day = date.getDate();
    const month = months[date.getMonth()];
    const year = date.getFullYear();
    const hours = String(date.getHours()).padStart(2, '0'); // Menambahkan nol di depan jika kurang dari 10
    const minutes = String(date.getMinutes()).padStart(2, '0'); // Menambahkan nol di depan jika kurang dari 10

    // Mengembalikan format yang diinginkan
    return `${day} ${month} ${year} jam ${hours}.${minutes}`;
}