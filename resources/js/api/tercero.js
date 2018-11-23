import request from '@/utils/request'

export function save(data) {
  return request({
    url: 'api/terceros/save',
    method: 'post',
    data
  })
}

export function update(data) {
  return request({
    url: 'api/terceros/update',
    method: 'put',
    data
  })
}

export function deleteRow(id) {
  return request({
    url: 'api/terceros/delete',
    method: 'delete',
    data: id
  })
}

export function terceroById(id) {
  return request({
    url: 'api/terceros/terceroById/' + id,
    method: 'get'
  })
}