import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-inspheric-url-field', IndexField)
  app.component('detail-inspheric-url-field', DetailField)
  app.component('form-inspheric-url-field', FormField)
})
