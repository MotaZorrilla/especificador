# OpenSpec Specification: Especificador v2.0 MVP (Hardware Licensing, Multitenancy & Stoichiometric Engine)

**Project:** Pintura Intumescente · Especificador v2.0 (`pinturaintumescente.cl`)  
**Protocol:** Protocolo 2 (Auditoría 7D & Spec-Driven Development)  
**Date:** 2026-10-23  
**Status:** Active / Ready for Protocolo 3 Implementation  

---

## 1. Formal EARS Requirements (RFC 2119)

### 1.1. Hardware-Bound Licensing & Session Control
* **REQ-LIC-01 (Ubiquitous):**  
  The system **SHALL** bind each active annual user license to a single physical computer identified by its composite `MachineFingerprint` ($\text{SHA-256}(\text{Motherboard UUID} + \text{CPU ID} + \text{BIOS Serial} + \text{MachineGuid})$).
* **REQ-LIC-02 (Unwanted Behavior):**  
  **IF** an authentication or calculation request is received with valid user credentials but a `MachineFingerprint` that does not match the registered active device for that license, **THEN** the system **SHALL** reject the request with HTTP status `403 Forbidden` and return the self-service device reassignment payload.
* **REQ-LIC-03 (Event-Driven):**  
  **WHEN** an authenticated user requests a hardware reassignment and `transfers_used_count < 2` within the current subscription year, the system **SHALL** revoke the previous `UserDevice` record, register the new `MachineFingerprint`, increment `transfers_used_count` by 1, and issue a new Ed25519 session token.
* **REQ-LIC-04 (Event-Driven):**  
  **WHEN** a new valid session is established for a user license, the system **SHALL** immediately invalidate all prior active session tokens for that `user_id` and terminate concurrent connections on subsequent requests.
* **REQ-LIC-05 (Unwanted Behavior - Anti-Clock Rollback):**  
  **IF** the local system clock on the client workstation is detected to be earlier than the `last_seen_monotonic_timestamp` stored during the previous execution, **THEN** the client **SHALL** invalidate the 7-day offline grace token and require immediate online re-authentication.

### 1.2. Multitenant Isolation & Security (Anti-IDOR)
* **REQ-SEC-01 (Ubiquitous):**  
  The system **SHALL** enforce strict tenant isolation across all `Project`, `Profile`, `Result`, and `Pdf` endpoints such that a user can only access records belonging to their assigned `tenant_id` (and where `is_private = false` or `user_id = auth()->id()`).
* **REQ-SEC-02 (Ubiquitous - Append-Only Commercial Royalty Audit):**  
  The system **SHALL** record every license creation, activation, renewal, and hardware transfer in an immutable `license_audit_logs` table to ensure transparent 20% royalty accounting.

### 1.3. Stoichiometric Engine & Batch Excel Processing
* **REQ-CALC-01 (State-Driven):**  
  **WHILE** the client application is operating on the user's workstation, the system **SHALL** execute all massivity ($S/V$) and dry film thickness (DFT/EPS for $F15$ to $F180$) lookups exclusively on the cloud backend (`MassivityCalculationEngine`), never transmitting full certification tables (`Filedata`) to local storage.
* **REQ-EXCEL-01 (Event-Driven):**  
  **WHEN** an engineer uploads an Excel spreadsheet containing up to 2,500 structural profiles, the system **SHALL** validate each row, skip malformed rows with structured error logging, and persist valid profiles in batches of 500 inside a database transaction in less than 3 seconds.

### 1.4. Cryptographic PDF Certificates & Mobile Field Viewer
* **REQ-QR-01 (Ubiquitous):**  
  The system **SHALL** embed a unique `document_verification_uuid`, a SHA-256 `document_integrity_hash`, and a vector QR code into every official PDF calculation report.
* **REQ-QR-02 (Optional / Mobile Field Access):**  
  **WHERE** a user or technical inspector (ITO) accesses the mobile verification URL `/verify/{document_uuid}` from any mobile or desktop browser, the system **SHALL** display the read-only certification status and structural profile summary without consuming or requiring a workstation calculation license.

---

## 2. Executable BDD Scenarios (GIVEN / WHEN / THEN)

### Scenario 1: Hardware Lock Rejection on Second Machine
* **GIVEN** an active user license bound to `PC-OFFICE-01` (`hardware_fingerprint_hash: a1b2c3...`)
* **WHEN** a request to calculate profiles or open the dashboard is sent with the same user credentials from `PC-HOME-02` (`hardware_fingerprint_hash: f9e8d7...`)
* **THEN** the API responds with `403 Forbidden` and payload `{"error": "DEVICE_MISMATCH", "remaining_transfers": 2}`.

### Scenario 2: Successful Self-Service Hardware Reassignment
* **GIVEN** an active user license bound to `PC-OFFICE-01` with `transfers_used_count = 0` and `max_transfers_per_year = 2`
* **WHEN** the user submits a reassignment confirmation for `PC-NEW-LAPTOP` (`hardware_fingerprint_hash: 998877...`)
* **THEN** `PC-OFFICE-01` is marked `is_active = false`, `PC-NEW-LAPTOP` is registered as active, `transfers_used_count` becomes `1`, and access is granted with `200 OK`.

### Scenario 3: Rejection of Third Hardware Reassignment in Same Year (Unhappy Path)
* **GIVEN** an active user license with `transfers_used_count = 2` and `max_transfers_per_year = 2`
* **WHEN** the user attempts to reassign the license to a third machine
* **THEN** the system rejects the request with `422 Unprocessable Entity` and message `"Has alcanzado el límite de 2 transferencias anuales de equipo."`

### Scenario 4: Cross-Tenant IDOR Prevention on PDF and Profile Endpoints (Unhappy Path)
* **GIVEN** `User A` belonging to `Tenant 1` and `Project #50` belonging to `Tenant 2`
* **WHEN** `User A` sends `GET /pdf/50` or `DELETE /profile/50`
* **THEN** the system returns `403 Forbidden` (or `404 Not Found` via `TenantScope`) and leaves `Project #50` untouched.

### Scenario 5: Resilient Batch Import of 1,500 Profiles with Malformed Rows
* **GIVEN** an Excel file with 1,500 profile rows where 1,497 are valid and 3 contain non-numeric thickness values
* **WHEN** the file is processed by `ProjectProfileBatchService`
* **THEN** 1,497 profiles are calculated and batch-inserted within a single transaction in `< 3 seconds`, and the response lists the exact 3 skipped rows with their validation reasons.
