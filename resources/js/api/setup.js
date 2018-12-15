import request from '@/utils/request'

export function setup() {
  return request({
    url: 'api/setup/get',
    method: 'get'
  })
}
