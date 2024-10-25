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