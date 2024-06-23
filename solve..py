import base64

old_iv_b64 = "gm/WtMlZ15f6ndkPjNLoDw=="
encrypted_message_b64 = "+I2Hy6zLyxbVASbTJTjZ2g=="

old_iv = base64.b64decode(old_iv_b64)

# XOR the old plaintext with the new one:
old_plaintext = b"user\x0c\x0c\x0c\x0c\x0c\x0c\x0c\x0c\x0c\x0c\x0c\x0c"
new_plaintext = b"blackhole\x0a\x06\x06\x06\x06\x06\x06\x06"
intermediate_value = bytes(a ^ b for a, b in zip(old_plaintext, new_plaintext))

# XOR the IV with the intermediate value:
new_iv = bytes(a ^ b for a, b in zip(old_iv, intermediate_value))

# Encode the new IV back to base64:
new_iv_b64 = base64.b64encode(new_iv).decode()


# Generate the new cookie:
new_cookie = new_iv_b64 + "." + encrypted_message_b64

print(new_cookie)