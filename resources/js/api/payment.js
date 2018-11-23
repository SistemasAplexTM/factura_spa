import request from '@/utils/request'

export function save(data) {
  return request({
    url: 'api/payments/save',
    method: 'post',
    data
  })
}

export function update(data) {
  return request({
    url: 'api/payments/update',
    method: 'put',
    data
  })
}