const API_URL = 'http://192.168.0.108:8001/api';

export async function apiRequest(
  endpoint: string,
  method: string = 'GET',
  body?: object,
  token?: string
) {
  const response = await fetch(`${API_URL}${endpoint}`, {
    method,
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      ...(token ? { Authorization: `Bearer ${token}` } : {}),
    },
    ...(body ? { body: JSON.stringify(body) } : {}),
  });

  const data = await response.json();

  if (!response.ok) {
    throw new Error(
      data.message ||
      Object.values(data.errors || {}).flat().join('\n') ||
      'Terjadi kesalahan pada server.'
    );
  }

  return data;
}
