import request from '@/utils/request'

export function save(data) {
  return request({
    url: 'api/document/save',
    method: 'post',
    data
  })
}

export function update(data, id) {
  return request({
    url: 'api/document/update/' + id,
    method: 'put',
    data
  })
}

export function savePaymentMethod(data) {
  return request({
    url: 'api/document/savePaymentMethod',
    method: 'post',
    data
  })
}

export function getProductByCode(code, pormayor) {
  return request({
    url: 'api/documentDetail/documentDetail/' + code + '/' + pormayor,
    method: 'get'
  })
}

export function getCupon(data) {
  return request({
    url: 'api/document/getCupon/' + data,
    method: 'get'
  })
}

export function searchThird(data, type) {
  return request({
    url: 'api/terceros/terceroSearch/' + data + '/' + type,
    method: 'get'
  })
}
