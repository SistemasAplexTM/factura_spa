import request from '@/utils/request'

export function getProductByCode(code) {
  return request({
    url: 'api/documentDetail/documentDetail/' + code,
    method: 'get'
  })
}