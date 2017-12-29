axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

new Vue({
	el: '#index-patients',

	data: {
		patient: {
            'id': '',
            'name': '',
            'email': '',
            'address': '',
            'phone': '',
            'age': '',
            'sex': 1,
        },
        patients: [],
        paginate: ['patients'],
		modal: {
			id: ''
		},
        search: {
            'name': '',
        },
	},
    mounted: function(){
        this.listPatients();
    },
	methods: {
        resetData: function() {
            this.patient = {
                'id': '',
                'name': '',
                'email': '',
                'address': '',
                'phone': '',
                'age': '',
                'sex': 1,
            };
        },
        /**
         * Pham Viet Toan
         * 09/21/2017
         *
         * List patients
         */
        listPatients: function() {
            var authOptions = {
                method: 'get',
                url: '/admin/listPatients',
                json: true
            }
            axios(authOptions).then(response => {
                this.patients = response.data;
            });
        },

        /**
         * Pham Viet Toan
         * 09/21/2017
         *
         * delete patient with id
         * @param id
         * HTML DOM
         */
		deletePatient: function(id) {
            let list = this;
            swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
                }).then(function () {
                    var authOptions = {
                        method: 'DELETE',
                        url: '/admin/patient/' + id,
                        json: true
                    }
                    axios(authOptions).then(response => {
                        swal(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        );
                        list.listPatients();
                    });
                }, function (dismiss) {
                    if (dismiss === 'cancel') {
                        swal(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                        )
                    }
            });
        },
        createPatient: function () {
            this.resetData();
            $('#newPatient').modal('show');
        },
        storePatient: function() {
            var authOptions = {
                method: 'post',
                params: this.patient,
                url: '/admin/patient',
                json: true
            }
            axios(authOptions).then(response => {
                if (response.data.status == 'success') {
                    toastr.success(response.data.message, response.data.action, {timeOut: 10000});
                    $('#newPatient').modal('hide');
                }

                if (response.data.status == 'error') {
                    toastr.error(response.data.message, response.data.action, {timeOut: 10000});
                }

                if (response.data.status == 'unique') {
                    toastr.warning(response.data.message, response.data.name, {timeOut: 10000});
                }
                this.listPatients();
            }).catch(error => {
                if (error.response.data.email) {
                    toastr.error(error.response.data.email, '', {timeOut: 5000});
                }
                if (error.response.data.phone) {
                    toastr.error(error.response.data.phone, '', {timeOut: 5000});
                }
                if (error.response.data.age) {
                    toastr.error(error.response.data.age, '', {timeOut: 5000});
                }
                if (error.response.data.name) {
                    toastr.error(error.response.data.name, '', {timeOut: 5000});
                }
                if (error.response.data.address) {
                    toastr.error(error.response.data.address, '', {timeOut: 5000});
                }
                if (error.response.data.sex) {
                    toastr.error(error.response.data.sex, '', {timeOut: 5000});
                }
            });
        },
        editPatient: function(id) {
            var authOptions = {
                method: 'get',
                url: '/admin/patient/' + id + '/edit',
                json: true
            }
            axios(authOptions).then(response => {
                this.patient = response.data;
                $('#updatePatient').modal('show');
            });
        },
        updatePatient: function(id) {
            var authOptions = {
                method: 'put',
                params: this.patient,
                url: '/admin/patient/' + id,
                json: true
            }
            axios(authOptions).then(response => {
                if (response.status == 200) {
                    toastr.success(response.data, '', {timeOut: 5000});

                } else {
                    toastr.error(response.data, '', {timeOut: 5000});
                }
                $('#updatePatient').modal('hide');
                this.listPatients();
            }).catch(error => {
                if (error.response.data.email) {
                    toastr.error(error.response.data.email, '', {timeOut: 5000});
                }
                if (error.response.data.phone) {
                    toastr.error(error.response.data.phone, '', {timeOut: 5000});
                }
                if (error.response.data.age) {
                    toastr.error(error.response.data.age, '', {timeOut: 5000});
                }
                if (error.response.data.name) {
                    toastr.error(error.response.data.name, '', {timeOut: 5000});
                }
                if (error.response.data.address) {
                    toastr.error(error.response.data.address, '', {timeOut: 5000});
                }
                if (error.response.data.sex) {
                    toastr.error(error.response.data.sex, '', {timeOut: 5000});
                }
            });
        },
        addIdModal: function(id) {
            this.modal.id = id
        },
        searchPatient: function() {
            var authOptions = {
                method: 'post',
                url: '/admin/patient/search',
                params: { 'name': this.search.name },
                json: true
            }
            axios(authOptions).then(response => {
                this.patients = response.data;
            });
        },
    }
});
