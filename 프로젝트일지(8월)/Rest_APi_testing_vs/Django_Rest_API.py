# Rest API 파이썬으로 이해함 jsonplaceholder에서 예제 서버 들고옴 
import requests
import json

url = "https://jsonplaceholder.typicode.com/todos/1"
response = requests.request("GET", url, headers={}, data={})
code = response.status_code
print(code)

data = response.content
print(data)
print(type(data)) # 여기서는 지금 byte로 받아와 지는데,

data = json.loads(response.content)
print(type(data)) # 여기서는 dict 형태로 받아와 진다/.

# 이렇게 되면 우리가 뽑을 수 있게 된다.
identify = data['id']
