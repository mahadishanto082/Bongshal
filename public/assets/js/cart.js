var app = new Vue({
    el: '#main-wrapper',
    data: {
        cart_content : [],
        cart_count_total: 0,
        subtotal_amount: 0,
        total_amount: 0,
        total_discount_amount: 0,
        qty: 1,
        size: '',
        color: '',
        fabrics: '',
        reference_code: '',
        reference_status: '',
        reference_message: '',
    },

    mounted() {
        this.getCartContent()
    },

    methods: {
        getCartContent() {
            this.$http.get('/cart/all').then((response) => response.data)
                .then((response) => {
                    if (response.status === true) {
                        this.cart_content = response.data.cart_content
                        this.cart_count_total = response.data.cart_count_total
                        this.subtotal_amount = response.data.subtotal_amount
                        this.total_amount = response.data.total_amount
                        this.total_discount_amount = response.data.total_discount_amount
                    } else {
                        toastr.error(response.message, 'Error.. !!', {
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut",
                            "progressBar": true,
                            timeOut: 5000
                        });
                    }
                }).catch((error) => {
                    console.log(error);
                });
        },

        addToCart(url) {
            let _token = $('meta[name="csrf-token"]').attr('content')
            this.$http.post(url, {_token: _token, qty: this.qty, product_size: this.size, product_color: this.color, product_fabrics: this.fabrics}).then((response) => response.data).then((response) => {
                if (response.status === true) {
                    this.getCartContent()
                    toastr.success(response.message, 'Success.. !!', {
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut",
                        "progressBar": true,
                        timeOut: 5000
                    });
                } else {
                    toastr.error(response.message, 'Error.. !!', {
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut",
                        "progressBar": true,
                        timeOut: 5000
                    });
                }

            }).catch((error) => {
                console.log(error)
            });
        },

        qtyIncDec (type) {
            if (type === 'dec') {
                if (this.qty === 1) {
                    this.qty = 1
                } else {
                    this.qty -= 1
                }
            } else {
                this.qty +=1
            }
        },

        removeCart(cartId) {
            let url = '/cart/remove/'+cartId
            this.$http.get(url).then((response) => response.data).then((response) => {
                if (response.status === true) {
                    this.getCartContent()
                    toastr.success(response.message, 'Success.. !!', {
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut",
                        "progressBar": true,
                        timeOut: 5000
                    });
                } else {
                    toastr.error(response.message, 'Error.. !!', {
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut",
                        "progressBar": true,
                        timeOut: 5000
                    });
                }

            }).catch((error) => {
                console.log(error)
            });
        },

        destroyCart() {
            let url = '/cart/destroy'
            this.$http.get(url).then((response) => response.data).then((response) => {
                if (response.status === true) {
                    this.getCartContent()
                    toastr.success(response.message, 'Success.. !!', {
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut",
                        "progressBar": true,
                        timeOut: 5000
                    });
                } else {
                    toastr.error(response.message, 'Error.. !!', {
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut",
                        "progressBar": true,
                        timeOut: 5000
                    });
                }

            }).catch((error) => {
                console.log(error)
            });
        },

        updateCart(rowId, type) {
            let _token = $('meta[name="csrf-token"]').attr('content')
            this.$http.post('/cart/update/'+ rowId, {_token: _token, type: type}).then((response) => response.data)
                .then((response) => {
                    if (response.status === true) {
                        this.getCartContent()
                        toastr.success(response.message, 'Success.. !!', {
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut",
                            "progressBar": true,
                            timeOut: 5000
                        });
                    } else {
                        toastr.warning(response.message, 'Warning.. !!', {
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut",
                            "progressBar": true,
                            timeOut: 5000
                        });
                    }
                }).catch((error) => {
                console.log(error.response.data);
            });
        },

        decrement() {
            if (this.qty > 1) {
                this.qty = this.qty -1
            }

        },
        increment(stock) {
            if (this.qty < stock) {
                this.qty = this.qty + 1
            }
        },

        checkReference() {
            let _token = $('meta[name="csrf-token"]').attr('content')

            if (this.reference_code !== '') {
                this.$http.post('/check-reference', {_token: _token, reference_code: this.reference_code}).then((response) => response.data)
                    .then((response) => {
                        console.log(response)
                        if (response.status === true) {
                            this.reference_status = true
                            this.reference_message = response.message
                        } else {
                            this.reference_status = false
                            this.reference_message = response.message
                        }

                    }).catch((error) => {
                    console.log(error.response.data);
                    this.reference_status = ''
                    this.reference_message = ''
                });
            } else {
                this.reference_status = ''
                this.reference_message = ''
            }
        }
    }
});
