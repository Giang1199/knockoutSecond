define([
        'jquery',
        'uiComponent',
        'mage/validation',
        'ko',
        'Magento_Ui/js/modal/modal',
        'mage/url',
    ],
    function ($, Component, validation, ko, modal, urlBuilder) {
        'use strict';
        let title = "";
        return Component.extend({
            // employeeList: ko.observableArray([]),
            defaults: {
                template: 'Dtn_Knockout/list'
            },

            totalEmployee: ko.observableArray([]),
            initialize: function (config) {
                const self = this;
                this._super();
                // self.employee = ko.observableArray[self.employeeList];
                if (config.employeeList.length > 0) {
                    this.totalEmployee(config.employeeList);
                    return this;
                }
            },
            titles: function () {
                title = ko.observable("List Employee");
                return title;
            },

            currentEmployee: ko.observable(),

            // open modal edit
            editEmployee: function (employee){
                this.currentEmployee(employee);
                console.log(employee);
                const popup = $("#employee-form-popup");
                let option = {
                    type: 'popup',
                    title: 'Edit employee',
                    responsive: true,
                    clickableOverlay: true,
                    'buttons': [{
                        text: 'Cancel',
                        class: 'action',
                    }],
                    closed: function () {
                    }
                };
                modal(option, $(popup));
                $(popup).modal("openModal");
            },

            //open modal add
            addEmployee: function(){
                const popup = $("#employee-form-popup");
                this.currentEmployee();
                let option = {
                    type: 'popup',
                    title: 'Edit employee',
                    responsive: true,
                    clickableOverlay: true,
                    'buttons': [{
                        text: 'Cancel',
                        class: 'action',
                    }],
                    closed: function () {
                    }
                };
                modal(option, $(popup));
                $(popup).modal("openModal");
            },

            // add data
            save: function (data) {
                const url = urlBuilder.build("knockout/employee/create");
                const employee = {},
                self = this,
                //get all data
                formDataArray = $(data).serializeArray();
                // formDataArray = this.currentEmployee();
                formDataArray.forEach(function (entry) {
                    employee[entry.name] = entry.value;
                });
                // console.log(formDataArray);
                //foreach saveData to {'key': 'value'}
                formDataArray.forEach(function (entry) {
                    employee[entry.name] = entry.value;
                });
                if ($(data).validation() && $(data).validation('isValid')) {
                    $.ajax({
                        url: url,
                        data: JSON.stringify(employee),
                        type: "POST",
                        dataType: 'json',
                    })
                        .done(
                            function (response) {
                                if (response) {
                                    $.each(response, function (i, v) {
                                        const indx = self.findIndex(self.totalEmployee(), v.employee_id);
                                        if (indx == -1) {
                                            self.totalEmployee.unshift(v);
                                        } else {
                                            const oldItem = self.totalEmployee()[indx];
                                            self.totalEmployee.replace(oldItem, v);
                                        }
                                    });
                                }
                            }
                        )
                    $('.action-close').click();
                }
            },

            //check ton tai
            findIndex: function (arr, id) {
                let ind = -1;
                arr.forEach(function (item, index) {
                    if (item.employee_id == id) {
                        ind = index;
                    }
                });
                return ind;
            },

            // xoa
            remove: function (item) {
                const url = urlBuilder.build("knockout/employee/delete");
                const confirm_delete = confirm('xoa la phai insert lai day nhe');
                const self = this;
                if (confirm_delete) {
                    const data = item;
                    $.ajax({
                        url: url,
                        data: data,
                        type: "POST",
                        dataType: 'json',
                    })
                        .done(
                            function (response) {
                                if (response) {
                                    self.totalEmployee.remove(function (employee) {
                                        return employee.employee_id == response.employee_id;
                                    });
                                }
                            }
                        )
                }
            },

            getFirstname: function () {
                return typeof(this.currentEmployee()) != "undefined" ? this.currentEmployee().firstname:"";
            }
        });
    }
);
