Nova.booting((Vue, router, store) => {
  Vue.component('index-parental-field', require('./components/IndexField'))
  Vue.component('detail-parental-field', require('./components/DetailField'))
  Vue.component('form-parental-field', require('./components/FormField'))
})
