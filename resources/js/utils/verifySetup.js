export default (to, from, next) => {
  if (!localStorage.getItem('setup')) {
    if (to.path == '/setup') {
      next()
    }else{
     next({ path: 'setup', query: { route: to.path } })
    }
  }
  next()
}
