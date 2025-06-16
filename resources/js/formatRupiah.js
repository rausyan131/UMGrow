function rupiahInput() {
    return {
        numeric: 0,
        formatted: '',
        init(value) {
            this.numeric = value;
            this.formatted = this.formatRupiah(value);
        },
        format() {
            let clean = this.formatted.replace(/[^\d]/g, '');
            this.numeric = parseInt(clean) || 0;
            this.formatted = this.formatRupiah(this.numeric);
        },
        formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
            }).format(number);
        }
    }
}