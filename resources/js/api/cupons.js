import request from '@/utils/request'

export function save(data) {
  return request({
    url: 'api/cupons/save',
    method: 'post',
    data
  })
}

export function update(data) {
  return request({
    url: 'api/cupons/update',
    method: 'put',
    data
  })
}

export function deleteRow(id) {
  return request({
    url: 'api/cupons/delete',
    method: 'delete',
    data: id
  })
}

export function cuponsById(id) {
  return request({
    url: 'api/cupons/cuponsById/' + id,
    method: 'get'
  })
}