import base64
from urllib.parse import unquote

def xor_strings(str1, str2):
    result = bytes([a ^ b for a, b in zip(str1, str2)])
    return result

# XOR two strings
string1 = "hello"
string2 = "world"
xored_result = xor_strings(string1.encode(), string2.encode())

# Base64 and URL encoded value
base64_url_encoded_value = "NZXbEauK4gnCPdnAiO%2FXHA%3D%3D"  # Base64 and URL encoded string

# URL decode the value
decoded_url_value = unquote(base64_url_encoded_value)

# Base64 decode the value
decoded_base64_value = base64.b64decode(decoded_url_value)

# XOR operation with previously XORed result
final_result = xor_strings(decoded_base64_value, xored_result)

encoded_value = base64.b64encode(final_result)

print("XORed result of 'hello' and 'world':", xored_result.decode())
print("Decoded URL IV value:", decoded_url_value)
print("Decoded base64 IV value:", decoded_base64_value)
print("Final result after XOR operation with decoded values:", encoded_value)
