import request from '@/utils/request'

export function getProductByCode(code) {
  return request({
    url: 'api/documentDetail/documentDetail/' + code,
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
