<?php

// Fixture statis DIGENERATE oleh `php artisan rbac:sync-permissions` -- JANGAN
// disunting manual, akan tertimpa. Sumber kebenaran untuk RoleAndPermissionSeeder
// (grant baseline) dan RoutePermissionGate (peta izin saat request) -- keduanya
// TIDAK scan rute sendiri, cuma baca file ini supaya cepat di ribuan proses test.
// Generated: 2026-09-07 04:30:42

return array (
  0 => 
  array (
    'controller_action' => 'GET sanctum/csrf-cookie',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  1 => 
  array (
    'controller_action' => 'POST telescope/telescope-api/mail',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  2 => 
  array (
    'controller_action' => 'GET telescope/telescope-api/mail/{telescopeEntryId}',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  3 => 
  array (
    'controller_action' => 'GET telescope/telescope-api/mail/{telescopeEntryId}/preview',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  4 => 
  array (
    'controller_action' => 'GET telescope/telescope-api/mail/{telescopeEntryId}/download',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  5 => 
  array (
    'controller_action' => 'POST telescope/telescope-api/exceptions',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  6 => 
  array (
    'controller_action' => 'GET telescope/telescope-api/exceptions/{telescopeEntryId}',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  7 => 
  array (
    'controller_action' => 'PUT telescope/telescope-api/exceptions/{telescopeEntryId}',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  8 => 
  array (
    'controller_action' => 'POST telescope/telescope-api/dumps',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  9 => 
  array (
    'controller_action' => 'POST telescope/telescope-api/logs',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  10 => 
  array (
    'controller_action' => 'GET telescope/telescope-api/logs/{telescopeEntryId}',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  11 => 
  array (
    'controller_action' => 'POST telescope/telescope-api/notifications',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  12 => 
  array (
    'controller_action' => 'GET telescope/telescope-api/notifications/{telescopeEntryId}',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  13 => 
  array (
    'controller_action' => 'POST telescope/telescope-api/jobs',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  14 => 
  array (
    'controller_action' => 'GET telescope/telescope-api/jobs/{telescopeEntryId}',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  15 => 
  array (
    'controller_action' => 'POST telescope/telescope-api/batches',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  16 => 
  array (
    'controller_action' => 'GET telescope/telescope-api/batches/{telescopeEntryId}',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  17 => 
  array (
    'controller_action' => 'POST telescope/telescope-api/events',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  18 => 
  array (
    'controller_action' => 'GET telescope/telescope-api/events/{telescopeEntryId}',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  19 => 
  array (
    'controller_action' => 'POST telescope/telescope-api/gates',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  20 => 
  array (
    'controller_action' => 'GET telescope/telescope-api/gates/{telescopeEntryId}',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  21 => 
  array (
    'controller_action' => 'POST telescope/telescope-api/cache',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  22 => 
  array (
    'controller_action' => 'GET telescope/telescope-api/cache/{telescopeEntryId}',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  23 => 
  array (
    'controller_action' => 'POST telescope/telescope-api/queries',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  24 => 
  array (
    'controller_action' => 'GET telescope/telescope-api/queries/{telescopeEntryId}',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  25 => 
  array (
    'controller_action' => 'POST telescope/telescope-api/models',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  26 => 
  array (
    'controller_action' => 'GET telescope/telescope-api/models/{telescopeEntryId}',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  27 => 
  array (
    'controller_action' => 'POST telescope/telescope-api/requests',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  28 => 
  array (
    'controller_action' => 'GET telescope/telescope-api/requests/{telescopeEntryId}',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  29 => 
  array (
    'controller_action' => 'POST telescope/telescope-api/views',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  30 => 
  array (
    'controller_action' => 'GET telescope/telescope-api/views/{telescopeEntryId}',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  31 => 
  array (
    'controller_action' => 'POST telescope/telescope-api/commands',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  32 => 
  array (
    'controller_action' => 'GET telescope/telescope-api/commands/{telescopeEntryId}',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  33 => 
  array (
    'controller_action' => 'POST telescope/telescope-api/schedule',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  34 => 
  array (
    'controller_action' => 'GET telescope/telescope-api/schedule/{telescopeEntryId}',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  35 => 
  array (
    'controller_action' => 'POST telescope/telescope-api/redis',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  36 => 
  array (
    'controller_action' => 'GET telescope/telescope-api/redis/{telescopeEntryId}',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  37 => 
  array (
    'controller_action' => 'POST telescope/telescope-api/client-requests',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  38 => 
  array (
    'controller_action' => 'GET telescope/telescope-api/client-requests/{telescopeEntryId}',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  39 => 
  array (
    'controller_action' => 'GET telescope/telescope-api/monitored-tags',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  40 => 
  array (
    'controller_action' => 'POST telescope/telescope-api/monitored-tags',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  41 => 
  array (
    'controller_action' => 'POST telescope/telescope-api/monitored-tags/delete',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  42 => 
  array (
    'controller_action' => 'POST telescope/telescope-api/toggle-recording',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  43 => 
  array (
    'controller_action' => 'DELETE telescope/telescope-api/entries',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  44 => 
  array (
    'controller_action' => 'GET telescope/{view?}',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  45 => 
  array (
    'controller_action' => 'GET up',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  46 => 
  array (
    'controller_action' => 'Modules\\AplikasiSetting\\Http\\Controllers\\RsSettingController@index',
    'permission' => 'aplikasi-setting.rs-setting.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  47 => 
  array (
    'controller_action' => 'Modules\\AplikasiSetting\\Http\\Controllers\\RsSettingController@show',
    'permission' => 'aplikasi-setting.rs-setting.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  48 => 
  array (
    'controller_action' => 'Modules\\AplikasiSetting\\Http\\Controllers\\RsSettingController@store',
    'permission' => 'aplikasi-setting.rs-setting.store',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  49 => 
  array (
    'controller_action' => 'Modules\\AplikasiSetting\\Http\\Controllers\\RsSettingController@update',
    'permission' => 'aplikasi-setting.rs-setting.update',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  50 => 
  array (
    'controller_action' => 'Modules\\AplikasiSetting\\Http\\Controllers\\RsSettingController@update',
    'permission' => 'aplikasi-setting.rs-setting.update',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  51 => 
  array (
    'controller_action' => 'Modules\\AuditActivityLog\\Http\\Controllers\\ActivityLogController@index',
    'permission' => 'audit-activity-log.activity-log.index',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  52 => 
  array (
    'controller_action' => 'Modules\\AuditIncidentReport\\Http\\Controllers\\IncidentReportController@index',
    'permission' => 'audit-incident-report.incident-report.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  53 => 
  array (
    'controller_action' => 'Modules\\AuditIncidentReport\\Http\\Controllers\\IncidentReportController@show',
    'permission' => 'audit-incident-report.incident-report.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  54 => 
  array (
    'controller_action' => 'Modules\\AuditIncidentReport\\Http\\Controllers\\IncidentReportController@store',
    'permission' => 'audit-incident-report.incident-report.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  55 => 
  array (
    'controller_action' => 'Modules\\AuditIncidentReport\\Http\\Controllers\\IncidentReportController@update',
    'permission' => 'audit-incident-report.incident-report.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  56 => 
  array (
    'controller_action' => 'Modules\\AuditIncidentReport\\Http\\Controllers\\IncidentReportController@investigate',
    'permission' => 'audit-incident-report.incident-report.investigate',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  57 => 
  array (
    'controller_action' => 'Modules\\AuditIncidentReport\\Http\\Controllers\\IncidentReportController@requireRca',
    'permission' => 'audit-incident-report.incident-report.require-rca',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  58 => 
  array (
    'controller_action' => 'Modules\\AuditIncidentReport\\Http\\Controllers\\IncidentReportController@close',
    'permission' => 'audit-incident-report.incident-report.close',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  59 => 
  array (
    'controller_action' => 'Modules\\AuditInfectionSurveillance\\Http\\Controllers\\SurveillanceRateController@rate',
    'permission' => 'audit-infection-surveillance.surveillance-rate.rate',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  60 => 
  array (
    'controller_action' => 'Modules\\AuditInfectionSurveillance\\Http\\Controllers\\DeviceDayController@index',
    'permission' => 'audit-infection-surveillance.device-day.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  61 => 
  array (
    'controller_action' => 'Modules\\AuditInfectionSurveillance\\Http\\Controllers\\DeviceDayController@show',
    'permission' => 'audit-infection-surveillance.device-day.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  62 => 
  array (
    'controller_action' => 'Modules\\AuditInfectionSurveillance\\Http\\Controllers\\InfectionCaseController@index',
    'permission' => 'audit-infection-surveillance.infection-case.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  63 => 
  array (
    'controller_action' => 'Modules\\AuditInfectionSurveillance\\Http\\Controllers\\InfectionCaseController@show',
    'permission' => 'audit-infection-surveillance.infection-case.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  64 => 
  array (
    'controller_action' => 'Modules\\AuditInfectionSurveillance\\Http\\Controllers\\DeviceDayController@store',
    'permission' => 'audit-infection-surveillance.device-day.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  65 => 
  array (
    'controller_action' => 'Modules\\AuditInfectionSurveillance\\Http\\Controllers\\DeviceDayController@update',
    'permission' => 'audit-infection-surveillance.device-day.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  66 => 
  array (
    'controller_action' => 'Modules\\AuditInfectionSurveillance\\Http\\Controllers\\DeviceDayController@destroy',
    'permission' => 'audit-infection-surveillance.device-day.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  67 => 
  array (
    'controller_action' => 'Modules\\AuditInfectionSurveillance\\Http\\Controllers\\InfectionCaseController@store',
    'permission' => 'audit-infection-surveillance.infection-case.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  68 => 
  array (
    'controller_action' => 'Modules\\AuditInfectionSurveillance\\Http\\Controllers\\InfectionCaseController@update',
    'permission' => 'audit-infection-surveillance.infection-case.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  69 => 
  array (
    'controller_action' => 'Modules\\AuditInfectionSurveillance\\Http\\Controllers\\InfectionCaseController@destroy',
    'permission' => 'audit-infection-surveillance.infection-case.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  70 => 
  array (
    'controller_action' => 'Modules\\AuditQualityIndicator\\Http\\Controllers\\QualityIndicatorController@trend',
    'permission' => 'audit-quality-indicator.quality-indicator.trend',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  71 => 
  array (
    'controller_action' => 'Modules\\AuditQualityIndicator\\Http\\Controllers\\QualityIndicatorController@index',
    'permission' => 'audit-quality-indicator.quality-indicator.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  72 => 
  array (
    'controller_action' => 'Modules\\AuditQualityIndicator\\Http\\Controllers\\QualityIndicatorController@show',
    'permission' => 'audit-quality-indicator.quality-indicator.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  73 => 
  array (
    'controller_action' => 'Modules\\AuditQualityIndicator\\Http\\Controllers\\QualityIndicatorRecordController@index',
    'permission' => 'audit-quality-indicator.quality-indicator-record.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  74 => 
  array (
    'controller_action' => 'Modules\\AuditQualityIndicator\\Http\\Controllers\\QualityIndicatorRecordController@show',
    'permission' => 'audit-quality-indicator.quality-indicator-record.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  75 => 
  array (
    'controller_action' => 'Modules\\AuditQualityIndicator\\Http\\Controllers\\QualityIndicatorController@store',
    'permission' => 'audit-quality-indicator.quality-indicator.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  76 => 
  array (
    'controller_action' => 'Modules\\AuditQualityIndicator\\Http\\Controllers\\QualityIndicatorController@update',
    'permission' => 'audit-quality-indicator.quality-indicator.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  77 => 
  array (
    'controller_action' => 'Modules\\AuditQualityIndicator\\Http\\Controllers\\QualityIndicatorController@destroy',
    'permission' => 'audit-quality-indicator.quality-indicator.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  78 => 
  array (
    'controller_action' => 'Modules\\AuditQualityIndicator\\Http\\Controllers\\QualityIndicatorRecordController@store',
    'permission' => 'audit-quality-indicator.quality-indicator-record.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  79 => 
  array (
    'controller_action' => 'Modules\\AuditQualityIndicator\\Http\\Controllers\\QualityIndicatorRecordController@update',
    'permission' => 'audit-quality-indicator.quality-indicator-record.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  80 => 
  array (
    'controller_action' => 'Modules\\AuditQualityIndicator\\Http\\Controllers\\QualityIndicatorRecordController@destroy',
    'permission' => 'audit-quality-indicator.quality-indicator-record.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  81 => 
  array (
    'controller_action' => 'Modules\\AuditRequestLog\\Http\\Controllers\\RequestLogController@index',
    'permission' => 'audit-request-log.request-log.index',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  82 => 
  array (
    'controller_action' => 'Modules\\Auth\\Http\\Controllers\\AuthController@login',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  83 => 
  array (
    'controller_action' => 'Modules\\Auth\\Http\\Controllers\\AuthController@logout',
    'permission' => 'auth.auth.logout',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  84 => 
  array (
    'controller_action' => 'Modules\\Auth\\Http\\Controllers\\AuthController@logoutAll',
    'permission' => 'auth.auth.logout-all',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  85 => 
  array (
    'controller_action' => 'Modules\\Auth\\Http\\Controllers\\AuthController@me',
    'permission' => 'auth.auth.me',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  86 => 
  array (
    'controller_action' => 'Modules\\Auth\\Http\\Controllers\\MyAccountController@updateProfile',
    'permission' => 'auth.my-account.update-profile',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  87 => 
  array (
    'controller_action' => 'Modules\\Auth\\Http\\Controllers\\MyAccountController@updatePassword',
    'permission' => 'auth.my-account.update-password',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  88 => 
  array (
    'controller_action' => 'Modules\\Auth\\Http\\Controllers\\MyAccountController@sessions',
    'permission' => 'auth.my-account.sessions',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  89 => 
  array (
    'controller_action' => 'Modules\\Auth\\Http\\Controllers\\MyAccountController@revokeAllSessions',
    'permission' => 'auth.my-account.revoke-all-sessions',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  90 => 
  array (
    'controller_action' => 'Modules\\Auth\\Http\\Controllers\\UserController@index',
    'permission' => 'auth.user.index',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  91 => 
  array (
    'controller_action' => 'Modules\\Auth\\Http\\Controllers\\UserController@store',
    'permission' => 'auth.user.store',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  92 => 
  array (
    'controller_action' => 'Modules\\Auth\\Http\\Controllers\\UserController@show',
    'permission' => 'auth.user.show',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  93 => 
  array (
    'controller_action' => 'Modules\\Auth\\Http\\Controllers\\UserController@update',
    'permission' => 'auth.user.update',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  94 => 
  array (
    'controller_action' => 'Modules\\Auth\\Http\\Controllers\\UserController@destroy',
    'permission' => 'auth.user.destroy',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  95 => 
  array (
    'controller_action' => 'Modules\\Authorization\\Http\\Controllers\\MyAccessController@index',
    'permission' => 'authorization.my-access.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  96 => 
  array (
    'controller_action' => 'Modules\\Authorization\\Http\\Controllers\\RoleController@index',
    'permission' => 'authorization.role.index',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  97 => 
  array (
    'controller_action' => 'Modules\\Authorization\\Http\\Controllers\\RoleController@store',
    'permission' => 'authorization.role.store',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  98 => 
  array (
    'controller_action' => 'Modules\\Authorization\\Http\\Controllers\\RoleController@show',
    'permission' => 'authorization.role.show',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  99 => 
  array (
    'controller_action' => 'Modules\\Authorization\\Http\\Controllers\\RoleController@update',
    'permission' => 'authorization.role.update',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  100 => 
  array (
    'controller_action' => 'Modules\\Authorization\\Http\\Controllers\\RoleController@destroy',
    'permission' => 'authorization.role.destroy',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  101 => 
  array (
    'controller_action' => 'Modules\\Authorization\\Http\\Controllers\\PermissionController@index',
    'permission' => 'authorization.permission.index',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  102 => 
  array (
    'controller_action' => 'Modules\\Authorization\\Http\\Controllers\\PermissionController@store',
    'permission' => 'authorization.permission.store',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  103 => 
  array (
    'controller_action' => 'Modules\\Authorization\\Http\\Controllers\\PermissionController@destroy',
    'permission' => 'authorization.permission.destroy',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  104 => 
  array (
    'controller_action' => 'Modules\\Authorization\\Http\\Controllers\\UserRoleController@index',
    'permission' => 'authorization.user-role.index',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  105 => 
  array (
    'controller_action' => 'Modules\\Authorization\\Http\\Controllers\\UserRoleController@sync',
    'permission' => 'authorization.user-role.sync',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  106 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimClaimCompleteness\\Http\\Controllers\\BerkasKlaimClaimCompletenessController@index',
    'permission' => 'berkas-klaim-claim-completeness.berkas-klaim-claim-completeness.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  107 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimClaimCompleteness\\Http\\Controllers\\BerkasKlaimClaimCompletenessController@show',
    'permission' => 'berkas-klaim-claim-completeness.berkas-klaim-claim-completeness.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  108 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimClaimCompleteness\\Http\\Controllers\\BerkasKlaimClaimCompletenessController@store',
    'permission' => 'berkas-klaim-claim-completeness.berkas-klaim-claim-completeness.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  109 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimClaimCompleteness\\Http\\Controllers\\BerkasKlaimClaimCompletenessController@update',
    'permission' => 'berkas-klaim-claim-completeness.berkas-klaim-claim-completeness.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  110 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimClaimCompleteness\\Http\\Controllers\\BerkasKlaimClaimCompletenessController@destroy',
    'permission' => 'berkas-klaim-claim-completeness.berkas-klaim-claim-completeness.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  111 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimClaimCompletenessComment\\Http\\Controllers\\BerkasKlaimClaimCompletenessCommentController@index',
    'permission' => 'berkas-klaim-claim-completeness-comment.berkas-klaim-claim-completeness-comment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  112 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimClaimCompletenessComment\\Http\\Controllers\\BerkasKlaimClaimCompletenessCommentController@show',
    'permission' => 'berkas-klaim-claim-completeness-comment.berkas-klaim-claim-completeness-comment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  113 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimClaimCompletenessComment\\Http\\Controllers\\BerkasKlaimClaimCompletenessCommentController@store',
    'permission' => 'berkas-klaim-claim-completeness-comment.berkas-klaim-claim-completeness-comment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  114 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimClaimCompletenessComment\\Http\\Controllers\\BerkasKlaimClaimCompletenessCommentController@update',
    'permission' => 'berkas-klaim-claim-completeness-comment.berkas-klaim-claim-completeness-comment.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  115 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimClaimCompletenessComment\\Http\\Controllers\\BerkasKlaimClaimCompletenessCommentController@destroy',
    'permission' => 'berkas-klaim-claim-completeness-comment.berkas-klaim-claim-completeness-comment.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  116 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimClaimFile\\Http\\Controllers\\BerkasKlaimClaimFileController@index',
    'permission' => 'berkas-klaim-claim-file.berkas-klaim-claim-file.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  117 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimClaimFile\\Http\\Controllers\\BerkasKlaimClaimFileController@show',
    'permission' => 'berkas-klaim-claim-file.berkas-klaim-claim-file.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  118 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimClaimFile\\Http\\Controllers\\BerkasKlaimClaimFileController@store',
    'permission' => 'berkas-klaim-claim-file.berkas-klaim-claim-file.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  119 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimClaimFile\\Http\\Controllers\\BerkasKlaimClaimFileController@update',
    'permission' => 'berkas-klaim-claim-file.berkas-klaim-claim-file.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  120 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimClaimFile\\Http\\Controllers\\BerkasKlaimClaimFileController@destroy',
    'permission' => 'berkas-klaim-claim-file.berkas-klaim-claim-file.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  121 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimClinicalLabClaim\\Http\\Controllers\\ClinicalLabClaimController@index',
    'permission' => 'berkas-klaim-clinical-lab-claim.clinical-lab-claim.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  122 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimClinicalLabClaim\\Http\\Controllers\\ClinicalLabClaimController@store',
    'permission' => 'berkas-klaim-clinical-lab-claim.clinical-lab-claim.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  123 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimClinicalLabClaim\\Http\\Controllers\\ClinicalLabClaimController@show',
    'permission' => 'berkas-klaim-clinical-lab-claim.clinical-lab-claim.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  124 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimClinicalLabClaim\\Http\\Controllers\\ClinicalLabClaimController@transition',
    'permission' => 'berkas-klaim-clinical-lab-claim.clinical-lab-claim.transition',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  125 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimClinicalLabClaimItem\\Http\\Controllers\\ClinicalLabClaimItemController@index',
    'permission' => 'berkas-klaim-clinical-lab-claim-item.clinical-lab-claim-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  126 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimClinicalLabClaimItem\\Http\\Controllers\\ClinicalLabClaimItemController@show',
    'permission' => 'berkas-klaim-clinical-lab-claim-item.clinical-lab-claim-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  127 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimClinicalLabClaimItem\\Http\\Controllers\\ClinicalLabClaimItemController@store',
    'permission' => 'berkas-klaim-clinical-lab-claim-item.clinical-lab-claim-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  128 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimPathologyClaim\\Http\\Controllers\\PathologyClaimController@index',
    'permission' => 'berkas-klaim-pathology-claim.pathology-claim.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  129 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimPathologyClaim\\Http\\Controllers\\PathologyClaimController@store',
    'permission' => 'berkas-klaim-pathology-claim.pathology-claim.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  130 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimPathologyClaim\\Http\\Controllers\\PathologyClaimController@show',
    'permission' => 'berkas-klaim-pathology-claim.pathology-claim.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  131 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimPathologyClaim\\Http\\Controllers\\PathologyClaimController@transition',
    'permission' => 'berkas-klaim-pathology-claim.pathology-claim.transition',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  132 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimPathologyClaimItem\\Http\\Controllers\\PathologyClaimItemController@index',
    'permission' => 'berkas-klaim-pathology-claim-item.pathology-claim-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  133 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimPathologyClaimItem\\Http\\Controllers\\PathologyClaimItemController@show',
    'permission' => 'berkas-klaim-pathology-claim-item.pathology-claim-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  134 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimPathologyClaimItem\\Http\\Controllers\\PathologyClaimItemController@store',
    'permission' => 'berkas-klaim-pathology-claim-item.pathology-claim-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  135 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimPharmacyClaim\\Http\\Controllers\\PharmacyClaimController@index',
    'permission' => 'berkas-klaim-pharmacy-claim.pharmacy-claim.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  136 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimPharmacyClaim\\Http\\Controllers\\PharmacyClaimController@store',
    'permission' => 'berkas-klaim-pharmacy-claim.pharmacy-claim.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  137 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimPharmacyClaim\\Http\\Controllers\\PharmacyClaimController@show',
    'permission' => 'berkas-klaim-pharmacy-claim.pharmacy-claim.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  138 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimPharmacyClaim\\Http\\Controllers\\PharmacyClaimController@transition',
    'permission' => 'berkas-klaim-pharmacy-claim.pharmacy-claim.transition',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  139 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimPharmacyClaimItem\\Http\\Controllers\\PharmacyClaimItemController@index',
    'permission' => 'berkas-klaim-pharmacy-claim-item.pharmacy-claim-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  140 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimPharmacyClaimItem\\Http\\Controllers\\PharmacyClaimItemController@show',
    'permission' => 'berkas-klaim-pharmacy-claim-item.pharmacy-claim-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  141 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimPharmacyClaimItem\\Http\\Controllers\\PharmacyClaimItemController@store',
    'permission' => 'berkas-klaim-pharmacy-claim-item.pharmacy-claim-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  142 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimRadiologyClaim\\Http\\Controllers\\RadiologyClaimController@index',
    'permission' => 'berkas-klaim-radiology-claim.radiology-claim.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  143 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimRadiologyClaim\\Http\\Controllers\\RadiologyClaimController@store',
    'permission' => 'berkas-klaim-radiology-claim.radiology-claim.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  144 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimRadiologyClaim\\Http\\Controllers\\RadiologyClaimController@show',
    'permission' => 'berkas-klaim-radiology-claim.radiology-claim.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  145 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimRadiologyClaim\\Http\\Controllers\\RadiologyClaimController@transition',
    'permission' => 'berkas-klaim-radiology-claim.radiology-claim.transition',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  146 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimRadiologyClaimItem\\Http\\Controllers\\RadiologyClaimItemController@index',
    'permission' => 'berkas-klaim-radiology-claim-item.radiology-claim-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  147 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimRadiologyClaimItem\\Http\\Controllers\\RadiologyClaimItemController@show',
    'permission' => 'berkas-klaim-radiology-claim-item.radiology-claim-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  148 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimRadiologyClaimItem\\Http\\Controllers\\RadiologyClaimItemController@store',
    'permission' => 'berkas-klaim-radiology-claim-item.radiology-claim-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  149 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimSupportingDocument\\Http\\Controllers\\BerkasKlaimSupportingDocumentController@index',
    'permission' => 'berkas-klaim-supporting-document.berkas-klaim-supporting-document.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  150 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimSupportingDocument\\Http\\Controllers\\BerkasKlaimSupportingDocumentController@show',
    'permission' => 'berkas-klaim-supporting-document.berkas-klaim-supporting-document.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  151 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimSupportingDocument\\Http\\Controllers\\BerkasKlaimSupportingDocumentController@store',
    'permission' => 'berkas-klaim-supporting-document.berkas-klaim-supporting-document.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  152 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimSupportingDocument\\Http\\Controllers\\BerkasKlaimSupportingDocumentController@update',
    'permission' => 'berkas-klaim-supporting-document.berkas-klaim-supporting-document.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  153 => 
  array (
    'controller_action' => 'Modules\\BerkasKlaimSupportingDocument\\Http\\Controllers\\BerkasKlaimSupportingDocumentController@destroy',
    'permission' => 'berkas-klaim-supporting-document.berkas-klaim-supporting-document.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  154 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\AntreanController@index',
    'permission' => 'bpjs-antrean-fktp.antrean.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  155 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\AntreanController@store',
    'permission' => 'bpjs-antrean-fktp.antrean.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  156 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\AntreanController@show',
    'permission' => 'bpjs-antrean-fktp.antrean.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  157 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\AntreanController@batal',
    'permission' => 'bpjs-antrean-fktp.antrean.batal',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  158 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\AntreanWaktuController@index',
    'permission' => 'bpjs-antrean-fktp.antrean-waktu.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  159 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\AntreanWaktuController@store',
    'permission' => 'bpjs-antrean-fktp.antrean-waktu.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  160 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\AntreanFarmasiController@store',
    'permission' => 'bpjs-antrean-fktp.antrean-farmasi.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  161 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\AntreanReferensiController@poli',
    'permission' => 'bpjs-antrean-fktp.antrean-referensi.poli',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  162 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\AntreanReferensiController@dokter',
    'permission' => 'bpjs-antrean-fktp.antrean-referensi.dokter',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  163 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\AntreanReferensiController@jadwalDokter',
    'permission' => 'bpjs-antrean-fktp.antrean-referensi.jadwal-dokter',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  164 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\AntreanReferensiController@poliFingerPrint',
    'permission' => 'bpjs-antrean-fktp.antrean-referensi.poli-finger-print',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  165 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\AntreanReferensiController@pasienFingerPrint',
    'permission' => 'bpjs-antrean-fktp.antrean-referensi.pasien-finger-print',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  166 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\AntreanJadwalDokterController@update',
    'permission' => 'bpjs-antrean-fktp.antrean-jadwal-dokter.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  167 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\AntreanDashboardController@perTanggal',
    'permission' => 'bpjs-antrean-fktp.antrean-dashboard.per-tanggal',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  168 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\AntreanDashboardController@perBulan',
    'permission' => 'bpjs-antrean-fktp.antrean-dashboard.per-bulan',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  169 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\AntreanLaporanController@perTanggal',
    'permission' => 'bpjs-antrean-fktp.antrean-laporan.per-tanggal',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  170 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\AntreanLaporanController@perKodeBooking',
    'permission' => 'bpjs-antrean-fktp.antrean-laporan.per-kode-booking',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  171 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\AntreanLaporanController@belumDilayani',
    'permission' => 'bpjs-antrean-fktp.antrean-laporan.belum-dilayani',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  172 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\AntreanLaporanController@belumDilayaniDetail',
    'permission' => 'bpjs-antrean-fktp.antrean-laporan.belum-dilayani-detail',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  173 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\MobileJknTokenController@index',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  174 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\MobileJknAntreanController@store',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  175 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\MobileJknAntreanController@show',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  176 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\MobileJknAntreanController@batal',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  177 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\MobileJknAntreanController@checkIn',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  178 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\MobileJknAntreanFarmasiController@store',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  179 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\MobileJknAntreanFarmasiController@show',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  180 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\MobileJknPasienBaruController@store',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  181 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\MobileJknJadwalOperasiController@index',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  182 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanFktp\\Http\\Controllers\\MobileJknJadwalOperasiController@show',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  183 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\AntreanController@index',
    'permission' => 'bpjs-antrean-rs.antrean.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  184 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\AntreanController@store',
    'permission' => 'bpjs-antrean-rs.antrean.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  185 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\AntreanController@show',
    'permission' => 'bpjs-antrean-rs.antrean.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  186 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\AntreanController@storeFromDestination',
    'permission' => 'bpjs-antrean-rs.antrean.store-from-destination',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  187 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\AntreanController@batal',
    'permission' => 'bpjs-antrean-rs.antrean.batal',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  188 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\AntreanWaktuController@index',
    'permission' => 'bpjs-antrean-rs.antrean-waktu.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  189 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\AntreanWaktuController@store',
    'permission' => 'bpjs-antrean-rs.antrean-waktu.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  190 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\AntreanFarmasiController@store',
    'permission' => 'bpjs-antrean-rs.antrean-farmasi.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  191 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\AntreanReferensiController@poli',
    'permission' => 'bpjs-antrean-rs.antrean-referensi.poli',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  192 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\AntreanReferensiController@dokter',
    'permission' => 'bpjs-antrean-rs.antrean-referensi.dokter',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  193 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\AntreanReferensiController@jadwalDokter',
    'permission' => 'bpjs-antrean-rs.antrean-referensi.jadwal-dokter',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  194 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\AntreanReferensiController@poliFingerPrint',
    'permission' => 'bpjs-antrean-rs.antrean-referensi.poli-finger-print',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  195 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\AntreanReferensiController@pasienFingerPrint',
    'permission' => 'bpjs-antrean-rs.antrean-referensi.pasien-finger-print',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  196 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\AntreanJadwalDokterController@update',
    'permission' => 'bpjs-antrean-rs.antrean-jadwal-dokter.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  197 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\BpjsCodeMappingController@index',
    'permission' => 'bpjs-antrean-rs.bpjs-code-mapping.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  198 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\BpjsCodeMappingController@store',
    'permission' => 'bpjs-antrean-rs.bpjs-code-mapping.store',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  199 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\BpjsCodeMappingController@show',
    'permission' => 'bpjs-antrean-rs.bpjs-code-mapping.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  200 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\BpjsCodeMappingController@update',
    'permission' => 'bpjs-antrean-rs.bpjs-code-mapping.update',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  201 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\BpjsCodeMappingController@destroy',
    'permission' => 'bpjs-antrean-rs.bpjs-code-mapping.destroy',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  202 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\AntreanDashboardController@perTanggal',
    'permission' => 'bpjs-antrean-rs.antrean-dashboard.per-tanggal',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  203 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\AntreanDashboardController@perBulan',
    'permission' => 'bpjs-antrean-rs.antrean-dashboard.per-bulan',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  204 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\AntreanLaporanController@perTanggal',
    'permission' => 'bpjs-antrean-rs.antrean-laporan.per-tanggal',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  205 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\AntreanLaporanController@perKodeBooking',
    'permission' => 'bpjs-antrean-rs.antrean-laporan.per-kode-booking',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  206 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\AntreanLaporanController@belumDilayani',
    'permission' => 'bpjs-antrean-rs.antrean-laporan.belum-dilayani',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  207 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\AntreanLaporanController@belumDilayaniDetail',
    'permission' => 'bpjs-antrean-rs.antrean-laporan.belum-dilayani-detail',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  208 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\MobileJknTokenController@index',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  209 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\MobileJknAntreanController@store',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  210 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\MobileJknAntreanController@show',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  211 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\MobileJknAntreanController@batal',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  212 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\MobileJknAntreanController@checkIn',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  213 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\MobileJknAntreanFarmasiController@store',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  214 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\MobileJknAntreanFarmasiController@show',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  215 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\MobileJknPasienBaruController@store',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  216 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\MobileJknJadwalOperasiController@index',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  217 => 
  array (
    'controller_action' => 'Modules\\BpjsAntreanRs\\Http\\Controllers\\MobileJknJadwalOperasiController@show',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  218 => 
  array (
    'controller_action' => 'Modules\\BpjsAplicares\\Http\\Controllers\\AplicaresReferensiController@kamar',
    'permission' => 'bpjs-aplicares.aplicares-referensi.kamar',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  219 => 
  array (
    'controller_action' => 'Modules\\BpjsAplicares\\Http\\Controllers\\AplicaresRoomController@index',
    'permission' => 'bpjs-aplicares.aplicares-room.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  220 => 
  array (
    'controller_action' => 'Modules\\BpjsAplicares\\Http\\Controllers\\AplicaresRoomController@store',
    'permission' => 'bpjs-aplicares.aplicares-room.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  221 => 
  array (
    'controller_action' => 'Modules\\BpjsAplicares\\Http\\Controllers\\AplicaresRoomController@show',
    'permission' => 'bpjs-aplicares.aplicares-room.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  222 => 
  array (
    'controller_action' => 'Modules\\BpjsAplicares\\Http\\Controllers\\AplicaresRoomController@destroy',
    'permission' => 'bpjs-aplicares.aplicares-room.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  223 => 
  array (
    'controller_action' => 'Modules\\BpjsAplicares\\Http\\Controllers\\AplicaresBedAvailabilityController@update',
    'permission' => 'bpjs-aplicares.aplicares-bed-availability.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  224 => 
  array (
    'controller_action' => 'Modules\\BpjsApotek\\Http\\Controllers\\ApotekReferensiController@dpho',
    'permission' => 'bpjs-apotek.apotek-referensi.dpho',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  225 => 
  array (
    'controller_action' => 'Modules\\BpjsApotek\\Http\\Controllers\\ApotekReferensiController@poli',
    'permission' => 'bpjs-apotek.apotek-referensi.poli',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  226 => 
  array (
    'controller_action' => 'Modules\\BpjsApotek\\Http\\Controllers\\ApotekReferensiController@faskes',
    'permission' => 'bpjs-apotek.apotek-referensi.faskes',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  227 => 
  array (
    'controller_action' => 'Modules\\BpjsApotek\\Http\\Controllers\\ApotekReferensiController@settingApotek',
    'permission' => 'bpjs-apotek.apotek-referensi.setting-apotek',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  228 => 
  array (
    'controller_action' => 'Modules\\BpjsApotek\\Http\\Controllers\\ApotekReferensiController@spesialistik',
    'permission' => 'bpjs-apotek.apotek-referensi.spesialistik',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  229 => 
  array (
    'controller_action' => 'Modules\\BpjsApotek\\Http\\Controllers\\ApotekReferensiController@obat',
    'permission' => 'bpjs-apotek.apotek-referensi.obat',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  230 => 
  array (
    'controller_action' => 'Modules\\BpjsApotek\\Http\\Controllers\\ApotekResepController@index',
    'permission' => 'bpjs-apotek.apotek-resep.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  231 => 
  array (
    'controller_action' => 'Modules\\BpjsApotek\\Http\\Controllers\\ApotekResepController@store',
    'permission' => 'bpjs-apotek.apotek-resep.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  232 => 
  array (
    'controller_action' => 'Modules\\BpjsApotek\\Http\\Controllers\\ApotekResepController@show',
    'permission' => 'bpjs-apotek.apotek-resep.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  233 => 
  array (
    'controller_action' => 'Modules\\BpjsApotek\\Http\\Controllers\\ApotekResepController@destroy',
    'permission' => 'bpjs-apotek.apotek-resep.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  234 => 
  array (
    'controller_action' => 'Modules\\BpjsApotek\\Http\\Controllers\\ApotekPelayananObatController@index',
    'permission' => 'bpjs-apotek.apotek-pelayanan-obat.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  235 => 
  array (
    'controller_action' => 'Modules\\BpjsApotek\\Http\\Controllers\\ApotekPelayananObatController@destroy',
    'permission' => 'bpjs-apotek.apotek-pelayanan-obat.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  236 => 
  array (
    'controller_action' => 'Modules\\BpjsApotek\\Http\\Controllers\\ApotekPelayananObatController@history',
    'permission' => 'bpjs-apotek.apotek-pelayanan-obat.history',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  237 => 
  array (
    'controller_action' => 'Modules\\BpjsApotek\\Http\\Controllers\\ApotekPenyimpananObatController@store',
    'permission' => 'bpjs-apotek.apotek-penyimpanan-obat.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  238 => 
  array (
    'controller_action' => 'Modules\\BpjsApotek\\Http\\Controllers\\ApotekPenyimpananObatController@show',
    'permission' => 'bpjs-apotek.apotek-penyimpanan-obat.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  239 => 
  array (
    'controller_action' => 'Modules\\BpjsApotek\\Http\\Controllers\\ApotekPenyimpananObatController@updateStok',
    'permission' => 'bpjs-apotek.apotek-penyimpanan-obat.update-stok',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  240 => 
  array (
    'controller_action' => 'Modules\\BpjsApotek\\Http\\Controllers\\ApotekSepController@show',
    'permission' => 'bpjs-apotek.apotek-sep.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  241 => 
  array (
    'controller_action' => 'Modules\\BpjsApotek\\Http\\Controllers\\ApotekMonitoringController@index',
    'permission' => 'bpjs-apotek.apotek-monitoring.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  242 => 
  array (
    'controller_action' => 'Modules\\BpjsApotek\\Http\\Controllers\\ApotekPrbController@index',
    'permission' => 'bpjs-apotek.apotek-prb.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  243 => 
  array (
    'controller_action' => 'Modules\\BpjsICare\\Http\\Controllers\\RiwayatPelayananController@validate',
    'permission' => 'bpjs-i-care.riwayat-pelayanan.validate',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  244 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\ReferenceController@diagnosa',
    'permission' => 'bpjs-p-care.reference.diagnosa',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  245 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\ReferenceController@dokter',
    'permission' => 'bpjs-p-care.reference.dokter',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  246 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\ReferenceController@kelompok',
    'permission' => 'bpjs-p-care.reference.kelompok',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  247 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\ReferenceController@kesadaran',
    'permission' => 'bpjs-p-care.reference.kesadaran',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  248 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\ReferenceController@obat',
    'permission' => 'bpjs-p-care.reference.obat',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  249 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\ReferenceController@poli',
    'permission' => 'bpjs-p-care.reference.poli',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  250 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\ReferenceController@provider',
    'permission' => 'bpjs-p-care.reference.provider',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  251 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\ReferenceController@spesialis',
    'permission' => 'bpjs-p-care.reference.spesialis',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  252 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\ReferenceController@statusPulang',
    'permission' => 'bpjs-p-care.reference.status-pulang',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  253 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\ReferenceController@peserta',
    'permission' => 'bpjs-p-care.reference.peserta',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  254 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\KunjunganController@rujukan',
    'permission' => 'bpjs-p-care.kunjungan.rujukan',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  255 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\KunjunganController@riwayat',
    'permission' => 'bpjs-p-care.kunjungan.riwayat',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  256 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\KunjunganController@index',
    'permission' => 'bpjs-p-care.kunjungan.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  257 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\KunjunganController@store',
    'permission' => 'bpjs-p-care.kunjungan.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  258 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\KunjunganController@show',
    'permission' => 'bpjs-p-care.kunjungan.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  259 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\KunjunganController@update',
    'permission' => 'bpjs-p-care.kunjungan.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  260 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\KunjunganController@destroy',
    'permission' => 'bpjs-p-care.kunjungan.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  261 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\PendaftaranController@byNomorUrut',
    'permission' => 'bpjs-p-care.pendaftaran.by-nomor-urut',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  262 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\PendaftaranController@provider',
    'permission' => 'bpjs-p-care.pendaftaran.provider',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  263 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\PendaftaranController@index',
    'permission' => 'bpjs-p-care.pendaftaran.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  264 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\PendaftaranController@store',
    'permission' => 'bpjs-p-care.pendaftaran.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  265 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\PendaftaranController@show',
    'permission' => 'bpjs-p-care.pendaftaran.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  266 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\PendaftaranController@destroy',
    'permission' => 'bpjs-p-care.pendaftaran.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  267 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\McuController@index',
    'permission' => 'bpjs-p-care.mcu.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  268 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\McuController@store',
    'permission' => 'bpjs-p-care.mcu.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  269 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\McuController@show',
    'permission' => 'bpjs-p-care.mcu.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  270 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\McuController@update',
    'permission' => 'bpjs-p-care.mcu.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  271 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\McuController@destroy',
    'permission' => 'bpjs-p-care.mcu.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  272 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\AlergiController@index',
    'permission' => 'bpjs-p-care.alergi.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  273 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\AlergiController@store',
    'permission' => 'bpjs-p-care.alergi.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  274 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\AlergiController@show',
    'permission' => 'bpjs-p-care.alergi.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  275 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\AlergiController@update',
    'permission' => 'bpjs-p-care.alergi.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  276 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\AlergiController@destroy',
    'permission' => 'bpjs-p-care.alergi.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  277 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\PrognosaController@index',
    'permission' => 'bpjs-p-care.prognosa.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  278 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\PrognosaController@store',
    'permission' => 'bpjs-p-care.prognosa.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  279 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\PrognosaController@show',
    'permission' => 'bpjs-p-care.prognosa.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  280 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\PrognosaController@update',
    'permission' => 'bpjs-p-care.prognosa.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  281 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\PrognosaController@destroy',
    'permission' => 'bpjs-p-care.prognosa.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  282 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\SkrinningController@index',
    'permission' => 'bpjs-p-care.skrinning.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  283 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\SkrinningController@store',
    'permission' => 'bpjs-p-care.skrinning.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  284 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\SkrinningController@show',
    'permission' => 'bpjs-p-care.skrinning.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  285 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\SkrinningController@update',
    'permission' => 'bpjs-p-care.skrinning.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  286 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\SkrinningController@destroy',
    'permission' => 'bpjs-p-care.skrinning.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  287 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\TindakanController@index',
    'permission' => 'bpjs-p-care.tindakan.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  288 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\TindakanController@store',
    'permission' => 'bpjs-p-care.tindakan.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  289 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\TindakanController@show',
    'permission' => 'bpjs-p-care.tindakan.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  290 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\TindakanController@update',
    'permission' => 'bpjs-p-care.tindakan.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  291 => 
  array (
    'controller_action' => 'Modules\\BpjsPCare\\Http\\Controllers\\TindakanController@destroy',
    'permission' => 'bpjs-p-care.tindakan.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  292 => 
  array (
    'controller_action' => 'Modules\\BpjsRekamMedis\\Http\\Controllers\\KlaimController@store',
    'permission' => 'bpjs-rekam-medis.klaim.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  293 => 
  array (
    'controller_action' => 'Modules\\BpjsRekamMedis\\Http\\Controllers\\KlaimController@show',
    'permission' => 'bpjs-rekam-medis.klaim.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  294 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\SepController@draftFromRegistration',
    'permission' => 'bpjs-v-claim.sep.draft-from-registration',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  295 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\SepController@index',
    'permission' => 'bpjs-v-claim.sep.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  296 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\SepController@store',
    'permission' => 'bpjs-v-claim.sep.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  297 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\SepController@show',
    'permission' => 'bpjs-v-claim.sep.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  298 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\SepController@update',
    'permission' => 'bpjs-v-claim.sep.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  299 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\SepController@destroy',
    'permission' => 'bpjs-v-claim.sep.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  300 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\SepPengajuanController@store',
    'permission' => 'bpjs-v-claim.sep-pengajuan.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  301 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\SepPengajuanController@approve',
    'permission' => 'bpjs-v-claim.sep-pengajuan.approve',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  302 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\RencanaKontrolController@index',
    'permission' => 'bpjs-v-claim.rencana-kontrol.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  303 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\RencanaKontrolController@store',
    'permission' => 'bpjs-v-claim.rencana-kontrol.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  304 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\RencanaKontrolController@show',
    'permission' => 'bpjs-v-claim.rencana-kontrol.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  305 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\RencanaKontrolController@update',
    'permission' => 'bpjs-v-claim.rencana-kontrol.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  306 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\RencanaKontrolController@destroy',
    'permission' => 'bpjs-v-claim.rencana-kontrol.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  307 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\RencanaKontrolController@listSpesialistik',
    'permission' => 'bpjs-v-claim.rencana-kontrol.list-spesialistik',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  308 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\RencanaKontrolController@jadwalPraktekDokter',
    'permission' => 'bpjs-v-claim.rencana-kontrol.jadwal-praktek-dokter',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  309 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\SpriController@index',
    'permission' => 'bpjs-v-claim.spri.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  310 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\SpriController@store',
    'permission' => 'bpjs-v-claim.spri.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  311 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\SpriController@show',
    'permission' => 'bpjs-v-claim.spri.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  312 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\SpriController@update',
    'permission' => 'bpjs-v-claim.spri.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  313 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\RujukanAntarRsController@index',
    'permission' => 'bpjs-v-claim.rujukan-antar-rs.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  314 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\RujukanAntarRsController@store',
    'permission' => 'bpjs-v-claim.rujukan-antar-rs.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  315 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\RujukanAntarRsController@show',
    'permission' => 'bpjs-v-claim.rujukan-antar-rs.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  316 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\RujukanAntarRsController@update',
    'permission' => 'bpjs-v-claim.rujukan-antar-rs.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  317 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\RujukanAntarRsController@destroy',
    'permission' => 'bpjs-v-claim.rujukan-antar-rs.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  318 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\RujukanKhususController@index',
    'permission' => 'bpjs-v-claim.rujukan-khusus.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  319 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\RujukanKhususController@store',
    'permission' => 'bpjs-v-claim.rujukan-khusus.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  320 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\RujukanKhususController@show',
    'permission' => 'bpjs-v-claim.rujukan-khusus.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  321 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\RujukanKhususController@destroy',
    'permission' => 'bpjs-v-claim.rujukan-khusus.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  322 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\PesertaController@byNoKartu',
    'permission' => 'bpjs-v-claim.peserta.by-no-kartu',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  323 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\PesertaController@byNik',
    'permission' => 'bpjs-v-claim.peserta.by-nik',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  324 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\PesertaController@suplesiJasaRaharja',
    'permission' => 'bpjs-v-claim.peserta.suplesi-jasa-raharja',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  325 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\ReferensiController@faskes',
    'permission' => 'bpjs-v-claim.referensi.faskes',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  326 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\ReferensiController@dokter',
    'permission' => 'bpjs-v-claim.referensi.dokter',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  327 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\ReferensiController@diagnosa',
    'permission' => 'bpjs-v-claim.referensi.diagnosa',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  328 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\ReferensiController@poli',
    'permission' => 'bpjs-v-claim.referensi.poli',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  329 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\ReferensiController@propinsi',
    'permission' => 'bpjs-v-claim.referensi.propinsi',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  330 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\ReferensiController@kabupaten',
    'permission' => 'bpjs-v-claim.referensi.kabupaten',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  331 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\ReferensiController@kecamatan',
    'permission' => 'bpjs-v-claim.referensi.kecamatan',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  332 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\ReferensiController@procedure',
    'permission' => 'bpjs-v-claim.referensi.procedure',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  333 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\PrbController@byNomor',
    'permission' => 'bpjs-v-claim.prb.by-nomor',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  334 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\PrbController@byTanggal',
    'permission' => 'bpjs-v-claim.prb.by-tanggal',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  335 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\LpkController@list',
    'permission' => 'bpjs-v-claim.lpk.list',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  336 => 
  array (
    'controller_action' => 'Modules\\BpjsVClaim\\Http\\Controllers\\MonitoringController@kunjungan',
    'permission' => 'bpjs-v-claim.monitoring.kunjungan',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  337 => 
  array (
    'controller_action' => 'Modules\\CetakanPrintDocument\\Http\\Controllers\\PrintDocumentController@index',
    'permission' => 'cetakan-print-document.print-document.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  338 => 
  array (
    'controller_action' => 'Modules\\CetakanPrintDocument\\Http\\Controllers\\PrintDocumentController@show',
    'permission' => 'cetakan-print-document.print-document.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  339 => 
  array (
    'controller_action' => 'Modules\\CetakanPrintDocument\\Http\\Controllers\\PrintDocumentController@pdf',
    'permission' => 'cetakan-print-document.print-document.pdf',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  340 => 
  array (
    'controller_action' => 'Modules\\CetakanPrintDocument\\Http\\Controllers\\PrintDocumentController@issue',
    'permission' => 'cetakan-print-document.print-document.issue',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  341 => 
  array (
    'controller_action' => 'Modules\\DashboardCore\\Http\\Controllers\\DashboardCoreController@core',
    'permission' => 'dashboard-core.dashboard-core.core',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  342 => 
  array (
    'controller_action' => 'Modules\\EKlaim\\Http\\Controllers\\EKlaimController@index',
    'permission' => 'e-klaim.e-klaim.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  343 => 
  array (
    'controller_action' => 'Modules\\EKlaim\\Http\\Controllers\\EKlaimController@show',
    'permission' => 'e-klaim.e-klaim.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  344 => 
  array (
    'controller_action' => 'Modules\\EKlaim\\Http\\Controllers\\EKlaimController@store',
    'permission' => 'e-klaim.e-klaim.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  345 => 
  array (
    'controller_action' => 'Modules\\FinanceGeneralLedger\\Http\\Controllers\\AccountController@index',
    'permission' => 'finance-general-ledger.account.index',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  346 => 
  array (
    'controller_action' => 'Modules\\FinanceGeneralLedger\\Http\\Controllers\\AccountController@show',
    'permission' => 'finance-general-ledger.account.show',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  347 => 
  array (
    'controller_action' => 'Modules\\FinanceGeneralLedger\\Http\\Controllers\\JournalEntryController@index',
    'permission' => 'finance-general-ledger.journal-entry.index',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  348 => 
  array (
    'controller_action' => 'Modules\\FinanceGeneralLedger\\Http\\Controllers\\JournalEntryController@show',
    'permission' => 'finance-general-ledger.journal-entry.show',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  349 => 
  array (
    'controller_action' => 'Modules\\GeneralAbsenceType\\Http\\Controllers\\AbsenceTypeController@index',
    'permission' => 'general-absence-type.absence-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  350 => 
  array (
    'controller_action' => 'Modules\\GeneralAbsenceType\\Http\\Controllers\\AbsenceTypeController@store',
    'permission' => 'general-absence-type.absence-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  351 => 
  array (
    'controller_action' => 'Modules\\GeneralAbsenceType\\Http\\Controllers\\AbsenceTypeController@show',
    'permission' => 'general-absence-type.absence-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  352 => 
  array (
    'controller_action' => 'Modules\\GeneralAbsenceType\\Http\\Controllers\\AbsenceTypeController@update',
    'permission' => 'general-absence-type.absence-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  353 => 
  array (
    'controller_action' => 'Modules\\GeneralAbsenceType\\Http\\Controllers\\AbsenceTypeController@destroy',
    'permission' => 'general-absence-type.absence-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  354 => 
  array (
    'controller_action' => 'Modules\\GeneralAccidentGuarantorType\\Http\\Controllers\\AccidentGuarantorTypeController@index',
    'permission' => 'general-accident-guarantor-type.accident-guarantor-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  355 => 
  array (
    'controller_action' => 'Modules\\GeneralAccidentGuarantorType\\Http\\Controllers\\AccidentGuarantorTypeController@show',
    'permission' => 'general-accident-guarantor-type.accident-guarantor-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  356 => 
  array (
    'controller_action' => 'Modules\\GeneralAccidentGuarantorType\\Http\\Controllers\\AccidentGuarantorTypeController@store',
    'permission' => 'general-accident-guarantor-type.accident-guarantor-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  357 => 
  array (
    'controller_action' => 'Modules\\GeneralAccidentGuarantorType\\Http\\Controllers\\AccidentGuarantorTypeController@update',
    'permission' => 'general-accident-guarantor-type.accident-guarantor-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  358 => 
  array (
    'controller_action' => 'Modules\\GeneralAccidentGuarantorType\\Http\\Controllers\\AccidentGuarantorTypeController@destroy',
    'permission' => 'general-accident-guarantor-type.accident-guarantor-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  359 => 
  array (
    'controller_action' => 'Modules\\GeneralAccommodationCalculationRule\\Http\\Controllers\\AccommodationCalculationRuleController@index',
    'permission' => 'general-accommodation-calculation-rule.accommodation-calculation-rule.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  360 => 
  array (
    'controller_action' => 'Modules\\GeneralAccommodationCalculationRule\\Http\\Controllers\\AccommodationCalculationRuleController@show',
    'permission' => 'general-accommodation-calculation-rule.accommodation-calculation-rule.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  361 => 
  array (
    'controller_action' => 'Modules\\GeneralAccommodationCalculationRule\\Http\\Controllers\\AccommodationCalculationRuleController@store',
    'permission' => 'general-accommodation-calculation-rule.accommodation-calculation-rule.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  362 => 
  array (
    'controller_action' => 'Modules\\GeneralAccommodationCalculationRule\\Http\\Controllers\\AccommodationCalculationRuleController@update',
    'permission' => 'general-accommodation-calculation-rule.accommodation-calculation-rule.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  363 => 
  array (
    'controller_action' => 'Modules\\GeneralAccommodationCalculationRule\\Http\\Controllers\\AccommodationCalculationRuleController@destroy',
    'permission' => 'general-accommodation-calculation-rule.accommodation-calculation-rule.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  364 => 
  array (
    'controller_action' => 'Modules\\GeneralActiveIngredient\\Http\\Controllers\\ActiveIngredientController@index',
    'permission' => 'general-active-ingredient.active-ingredient.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  365 => 
  array (
    'controller_action' => 'Modules\\GeneralActiveIngredient\\Http\\Controllers\\ActiveIngredientController@show',
    'permission' => 'general-active-ingredient.active-ingredient.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  366 => 
  array (
    'controller_action' => 'Modules\\GeneralActiveIngredient\\Http\\Controllers\\ActiveIngredientController@store',
    'permission' => 'general-active-ingredient.active-ingredient.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  367 => 
  array (
    'controller_action' => 'Modules\\GeneralActiveIngredient\\Http\\Controllers\\ActiveIngredientController@update',
    'permission' => 'general-active-ingredient.active-ingredient.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  368 => 
  array (
    'controller_action' => 'Modules\\GeneralActiveIngredient\\Http\\Controllers\\ActiveIngredientController@destroy',
    'permission' => 'general-active-ingredient.active-ingredient.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  369 => 
  array (
    'controller_action' => 'Modules\\GeneralAdministration\\Http\\Controllers\\AdministrationController@index',
    'permission' => 'general-administration.administration.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  370 => 
  array (
    'controller_action' => 'Modules\\GeneralAdministration\\Http\\Controllers\\AdministrationController@show',
    'permission' => 'general-administration.administration.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  371 => 
  array (
    'controller_action' => 'Modules\\GeneralAdministration\\Http\\Controllers\\AdministrationController@store',
    'permission' => 'general-administration.administration.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  372 => 
  array (
    'controller_action' => 'Modules\\GeneralAdministration\\Http\\Controllers\\AdministrationController@update',
    'permission' => 'general-administration.administration.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  373 => 
  array (
    'controller_action' => 'Modules\\GeneralAdministration\\Http\\Controllers\\AdministrationController@destroy',
    'permission' => 'general-administration.administration.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  374 => 
  array (
    'controller_action' => 'Modules\\GeneralAdministrationTariff\\Http\\Controllers\\AdministrationTariffController@index',
    'permission' => 'general-administration-tariff.administration-tariff.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  375 => 
  array (
    'controller_action' => 'Modules\\GeneralAdministrationTariff\\Http\\Controllers\\AdministrationTariffController@show',
    'permission' => 'general-administration-tariff.administration-tariff.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  376 => 
  array (
    'controller_action' => 'Modules\\GeneralAdministrationTariff\\Http\\Controllers\\AdministrationTariffController@store',
    'permission' => 'general-administration-tariff.administration-tariff.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  377 => 
  array (
    'controller_action' => 'Modules\\GeneralAdministrationTariff\\Http\\Controllers\\AdministrationTariffController@update',
    'permission' => 'general-administration-tariff.administration-tariff.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  378 => 
  array (
    'controller_action' => 'Modules\\GeneralAdministrationTariff\\Http\\Controllers\\AdministrationTariffController@destroy',
    'permission' => 'general-administration-tariff.administration-tariff.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  379 => 
  array (
    'controller_action' => 'Modules\\GeneralAdmissionDiagnosis\\Http\\Controllers\\AdmissionDiagnosisController@index',
    'permission' => 'general-admission-diagnosis.admission-diagnosis.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  380 => 
  array (
    'controller_action' => 'Modules\\GeneralAdmissionDiagnosis\\Http\\Controllers\\AdmissionDiagnosisController@show',
    'permission' => 'general-admission-diagnosis.admission-diagnosis.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  381 => 
  array (
    'controller_action' => 'Modules\\GeneralAdmissionDiagnosis\\Http\\Controllers\\AdmissionDiagnosisController@store',
    'permission' => 'general-admission-diagnosis.admission-diagnosis.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  382 => 
  array (
    'controller_action' => 'Modules\\GeneralAdmissionDiagnosis\\Http\\Controllers\\AdmissionDiagnosisController@update',
    'permission' => 'general-admission-diagnosis.admission-diagnosis.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  383 => 
  array (
    'controller_action' => 'Modules\\GeneralAdmissionDiagnosis\\Http\\Controllers\\AdmissionDiagnosisController@destroy',
    'permission' => 'general-admission-diagnosis.admission-diagnosis.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  384 => 
  array (
    'controller_action' => 'Modules\\GeneralAgeGroup\\Http\\Controllers\\AgeGroupController@index',
    'permission' => 'general-age-group.age-group.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  385 => 
  array (
    'controller_action' => 'Modules\\GeneralAgeGroup\\Http\\Controllers\\AgeGroupController@show',
    'permission' => 'general-age-group.age-group.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  386 => 
  array (
    'controller_action' => 'Modules\\GeneralAgeGroup\\Http\\Controllers\\AgeGroupController@store',
    'permission' => 'general-age-group.age-group.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  387 => 
  array (
    'controller_action' => 'Modules\\GeneralAgeGroup\\Http\\Controllers\\AgeGroupController@update',
    'permission' => 'general-age-group.age-group.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  388 => 
  array (
    'controller_action' => 'Modules\\GeneralAgeGroup\\Http\\Controllers\\AgeGroupController@destroy',
    'permission' => 'general-age-group.age-group.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  389 => 
  array (
    'controller_action' => 'Modules\\GeneralAmbulanceFleet\\Http\\Controllers\\AmbulanceController@index',
    'permission' => 'general-ambulance-fleet.ambulance.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  390 => 
  array (
    'controller_action' => 'Modules\\GeneralAmbulanceFleet\\Http\\Controllers\\AmbulanceController@show',
    'permission' => 'general-ambulance-fleet.ambulance.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  391 => 
  array (
    'controller_action' => 'Modules\\GeneralAmbulanceFleet\\Http\\Controllers\\AmbulanceTripController@index',
    'permission' => 'general-ambulance-fleet.ambulance-trip.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  392 => 
  array (
    'controller_action' => 'Modules\\GeneralAmbulanceFleet\\Http\\Controllers\\AmbulanceTripController@show',
    'permission' => 'general-ambulance-fleet.ambulance-trip.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  393 => 
  array (
    'controller_action' => 'Modules\\GeneralAmbulanceFleet\\Http\\Controllers\\AmbulanceController@store',
    'permission' => 'general-ambulance-fleet.ambulance.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  394 => 
  array (
    'controller_action' => 'Modules\\GeneralAmbulanceFleet\\Http\\Controllers\\AmbulanceController@update',
    'permission' => 'general-ambulance-fleet.ambulance.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  395 => 
  array (
    'controller_action' => 'Modules\\GeneralAmbulanceFleet\\Http\\Controllers\\AmbulanceTripController@store',
    'permission' => 'general-ambulance-fleet.ambulance-trip.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  396 => 
  array (
    'controller_action' => 'Modules\\GeneralAmbulanceFleet\\Http\\Controllers\\AmbulanceTripController@update',
    'permission' => 'general-ambulance-fleet.ambulance-trip.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  397 => 
  array (
    'controller_action' => 'Modules\\GeneralAmbulanceFleet\\Http\\Controllers\\AmbulanceTripController@complete',
    'permission' => 'general-ambulance-fleet.ambulance-trip.complete',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  398 => 
  array (
    'controller_action' => 'Modules\\GeneralAnatomyTemplate\\Http\\Controllers\\AnatomyTemplateController@index',
    'permission' => 'general-anatomy-template.anatomy-template.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  399 => 
  array (
    'controller_action' => 'Modules\\GeneralAnatomyTemplate\\Http\\Controllers\\AnatomyTemplateController@show',
    'permission' => 'general-anatomy-template.anatomy-template.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  400 => 
  array (
    'controller_action' => 'Modules\\GeneralAnatomyTemplate\\Http\\Controllers\\AnatomyTemplateController@store',
    'permission' => 'general-anatomy-template.anatomy-template.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  401 => 
  array (
    'controller_action' => 'Modules\\GeneralAnatomyTemplate\\Http\\Controllers\\AnatomyTemplateController@update',
    'permission' => 'general-anatomy-template.anatomy-template.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  402 => 
  array (
    'controller_action' => 'Modules\\GeneralAnatomyTemplate\\Http\\Controllers\\AnatomyTemplateController@destroy',
    'permission' => 'general-anatomy-template.anatomy-template.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  403 => 
  array (
    'controller_action' => 'Modules\\GeneralAnesthesiaType\\Http\\Controllers\\AnesthesiaTypeController@index',
    'permission' => 'general-anesthesia-type.anesthesia-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  404 => 
  array (
    'controller_action' => 'Modules\\GeneralAnesthesiaType\\Http\\Controllers\\AnesthesiaTypeController@show',
    'permission' => 'general-anesthesia-type.anesthesia-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  405 => 
  array (
    'controller_action' => 'Modules\\GeneralAnesthesiaType\\Http\\Controllers\\AnesthesiaTypeController@store',
    'permission' => 'general-anesthesia-type.anesthesia-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  406 => 
  array (
    'controller_action' => 'Modules\\GeneralAnesthesiaType\\Http\\Controllers\\AnesthesiaTypeController@update',
    'permission' => 'general-anesthesia-type.anesthesia-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  407 => 
  array (
    'controller_action' => 'Modules\\GeneralAnesthesiaType\\Http\\Controllers\\AnesthesiaTypeController@destroy',
    'permission' => 'general-anesthesia-type.anesthesia-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  408 => 
  array (
    'controller_action' => 'Modules\\GeneralAntibioticBacteriaMapping\\Http\\Controllers\\AntibioticBacteriaMappingController@index',
    'permission' => 'general-antibiotic-bacteria-mapping.antibiotic-bacteria-mapping.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  409 => 
  array (
    'controller_action' => 'Modules\\GeneralAntibioticBacteriaMapping\\Http\\Controllers\\AntibioticBacteriaMappingController@show',
    'permission' => 'general-antibiotic-bacteria-mapping.antibiotic-bacteria-mapping.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  410 => 
  array (
    'controller_action' => 'Modules\\GeneralAntibioticBacteriaMapping\\Http\\Controllers\\AntibioticBacteriaMappingController@store',
    'permission' => 'general-antibiotic-bacteria-mapping.antibiotic-bacteria-mapping.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  411 => 
  array (
    'controller_action' => 'Modules\\GeneralAntibioticBacteriaMapping\\Http\\Controllers\\AntibioticBacteriaMappingController@update',
    'permission' => 'general-antibiotic-bacteria-mapping.antibiotic-bacteria-mapping.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  412 => 
  array (
    'controller_action' => 'Modules\\GeneralAntibioticBacteriaMapping\\Http\\Controllers\\AntibioticBacteriaMappingController@destroy',
    'permission' => 'general-antibiotic-bacteria-mapping.antibiotic-bacteria-mapping.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  413 => 
  array (
    'controller_action' => 'Modules\\GeneralAntibioticRestriction\\Http\\Controllers\\AntibioticRestrictionController@index',
    'permission' => 'general-antibiotic-restriction.antibiotic-restriction.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  414 => 
  array (
    'controller_action' => 'Modules\\GeneralAntibioticRestriction\\Http\\Controllers\\AntibioticRestrictionController@show',
    'permission' => 'general-antibiotic-restriction.antibiotic-restriction.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  415 => 
  array (
    'controller_action' => 'Modules\\GeneralAntibioticRestriction\\Http\\Controllers\\AntibioticRestrictionController@store',
    'permission' => 'general-antibiotic-restriction.antibiotic-restriction.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  416 => 
  array (
    'controller_action' => 'Modules\\GeneralAntibioticRestriction\\Http\\Controllers\\AntibioticRestrictionController@update',
    'permission' => 'general-antibiotic-restriction.antibiotic-restriction.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  417 => 
  array (
    'controller_action' => 'Modules\\GeneralAntibioticRestriction\\Http\\Controllers\\AntibioticRestrictionController@destroy',
    'permission' => 'general-antibiotic-restriction.antibiotic-restriction.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  418 => 
  array (
    'controller_action' => 'Modules\\GeneralAudioAttachment\\Http\\Controllers\\AudioAttachmentController@index',
    'permission' => 'general-audio-attachment.audio-attachment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  419 => 
  array (
    'controller_action' => 'Modules\\GeneralAudioAttachment\\Http\\Controllers\\AudioAttachmentController@show',
    'permission' => 'general-audio-attachment.audio-attachment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  420 => 
  array (
    'controller_action' => 'Modules\\GeneralAudioAttachment\\Http\\Controllers\\AudioAttachmentController@store',
    'permission' => 'general-audio-attachment.audio-attachment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  421 => 
  array (
    'controller_action' => 'Modules\\GeneralAudioAttachment\\Http\\Controllers\\AudioAttachmentController@update',
    'permission' => 'general-audio-attachment.audio-attachment.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  422 => 
  array (
    'controller_action' => 'Modules\\GeneralAudioAttachment\\Http\\Controllers\\AudioAttachmentController@destroy',
    'permission' => 'general-audio-attachment.audio-attachment.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  423 => 
  array (
    'controller_action' => 'Modules\\GeneralBank\\Http\\Controllers\\BankController@index',
    'permission' => 'general-bank.bank.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  424 => 
  array (
    'controller_action' => 'Modules\\GeneralBank\\Http\\Controllers\\BankController@show',
    'permission' => 'general-bank.bank.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  425 => 
  array (
    'controller_action' => 'Modules\\GeneralBank\\Http\\Controllers\\BankController@store',
    'permission' => 'general-bank.bank.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  426 => 
  array (
    'controller_action' => 'Modules\\GeneralBank\\Http\\Controllers\\BankController@update',
    'permission' => 'general-bank.bank.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  427 => 
  array (
    'controller_action' => 'Modules\\GeneralBank\\Http\\Controllers\\BankController@destroy',
    'permission' => 'general-bank.bank.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  428 => 
  array (
    'controller_action' => 'Modules\\GeneralBankAccount\\Http\\Controllers\\BankAccountController@index',
    'permission' => 'general-bank-account.bank-account.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  429 => 
  array (
    'controller_action' => 'Modules\\GeneralBankAccount\\Http\\Controllers\\BankAccountController@show',
    'permission' => 'general-bank-account.bank-account.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  430 => 
  array (
    'controller_action' => 'Modules\\GeneralBankAccount\\Http\\Controllers\\BankAccountController@store',
    'permission' => 'general-bank-account.bank-account.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  431 => 
  array (
    'controller_action' => 'Modules\\GeneralBankAccount\\Http\\Controllers\\BankAccountController@update',
    'permission' => 'general-bank-account.bank-account.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  432 => 
  array (
    'controller_action' => 'Modules\\GeneralBankAccount\\Http\\Controllers\\BankAccountController@destroy',
    'permission' => 'general-bank-account.bank-account.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  433 => 
  array (
    'controller_action' => 'Modules\\GeneralBed\\Http\\Controllers\\BedController@index',
    'permission' => 'general-bed.bed.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  434 => 
  array (
    'controller_action' => 'Modules\\GeneralBed\\Http\\Controllers\\BedController@store',
    'permission' => 'general-bed.bed.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  435 => 
  array (
    'controller_action' => 'Modules\\GeneralBed\\Http\\Controllers\\BedController@show',
    'permission' => 'general-bed.bed.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  436 => 
  array (
    'controller_action' => 'Modules\\GeneralBed\\Http\\Controllers\\BedController@update',
    'permission' => 'general-bed.bed.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  437 => 
  array (
    'controller_action' => 'Modules\\GeneralBed\\Http\\Controllers\\BedController@destroy',
    'permission' => 'general-bed.bed.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  438 => 
  array (
    'controller_action' => 'Modules\\GeneralBed\\Http\\Controllers\\BedController@reserve',
    'permission' => 'general-bed.bed.reserve',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  439 => 
  array (
    'controller_action' => 'Modules\\GeneralBed\\Http\\Controllers\\BedController@releaseReservation',
    'permission' => 'general-bed.bed.release-reservation',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  440 => 
  array (
    'controller_action' => 'Modules\\GeneralBedStatus\\Http\\Controllers\\BedStatusController@index',
    'permission' => 'general-bed-status.bed-status.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  441 => 
  array (
    'controller_action' => 'Modules\\GeneralBedStatus\\Http\\Controllers\\BedStatusController@show',
    'permission' => 'general-bed-status.bed-status.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  442 => 
  array (
    'controller_action' => 'Modules\\GeneralBedStatus\\Http\\Controllers\\BedStatusController@store',
    'permission' => 'general-bed-status.bed-status.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  443 => 
  array (
    'controller_action' => 'Modules\\GeneralBedStatus\\Http\\Controllers\\BedStatusController@update',
    'permission' => 'general-bed-status.bed-status.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  444 => 
  array (
    'controller_action' => 'Modules\\GeneralBedStatus\\Http\\Controllers\\BedStatusController@destroy',
    'permission' => 'general-bed-status.bed-status.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  445 => 
  array (
    'controller_action' => 'Modules\\GeneralBirthplace\\Http\\Controllers\\BirthplaceController@index',
    'permission' => 'general-birthplace.birthplace.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  446 => 
  array (
    'controller_action' => 'Modules\\GeneralBirthplace\\Http\\Controllers\\BirthplaceController@show',
    'permission' => 'general-birthplace.birthplace.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  447 => 
  array (
    'controller_action' => 'Modules\\GeneralBirthplace\\Http\\Controllers\\BirthplaceController@store',
    'permission' => 'general-birthplace.birthplace.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  448 => 
  array (
    'controller_action' => 'Modules\\GeneralBirthplace\\Http\\Controllers\\BirthplaceController@update',
    'permission' => 'general-birthplace.birthplace.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  449 => 
  array (
    'controller_action' => 'Modules\\GeneralBirthplace\\Http\\Controllers\\BirthplaceController@destroy',
    'permission' => 'general-birthplace.birthplace.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  450 => 
  array (
    'controller_action' => 'Modules\\GeneralBridgeType\\Http\\Controllers\\BridgeTypeController@index',
    'permission' => 'general-bridge-type.bridge-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  451 => 
  array (
    'controller_action' => 'Modules\\GeneralBridgeType\\Http\\Controllers\\BridgeTypeController@show',
    'permission' => 'general-bridge-type.bridge-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  452 => 
  array (
    'controller_action' => 'Modules\\GeneralBridgeType\\Http\\Controllers\\BridgeTypeController@store',
    'permission' => 'general-bridge-type.bridge-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  453 => 
  array (
    'controller_action' => 'Modules\\GeneralBridgeType\\Http\\Controllers\\BridgeTypeController@update',
    'permission' => 'general-bridge-type.bridge-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  454 => 
  array (
    'controller_action' => 'Modules\\GeneralBridgeType\\Http\\Controllers\\BridgeTypeController@destroy',
    'permission' => 'general-bridge-type.bridge-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  455 => 
  array (
    'controller_action' => 'Modules\\GeneralCardType\\Http\\Controllers\\CardTypeController@index',
    'permission' => 'general-card-type.card-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  456 => 
  array (
    'controller_action' => 'Modules\\GeneralCardType\\Http\\Controllers\\CardTypeController@show',
    'permission' => 'general-card-type.card-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  457 => 
  array (
    'controller_action' => 'Modules\\GeneralCardType\\Http\\Controllers\\CardTypeController@store',
    'permission' => 'general-card-type.card-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  458 => 
  array (
    'controller_action' => 'Modules\\GeneralCardType\\Http\\Controllers\\CardTypeController@update',
    'permission' => 'general-card-type.card-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  459 => 
  array (
    'controller_action' => 'Modules\\GeneralCardType\\Http\\Controllers\\CardTypeController@destroy',
    'permission' => 'general-card-type.card-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  460 => 
  array (
    'controller_action' => 'Modules\\GeneralConsultationRoom\\Http\\Controllers\\GeneralConsultationRoomController@index',
    'permission' => 'general-consultation-room.general-consultation-room.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  461 => 
  array (
    'controller_action' => 'Modules\\GeneralConsultationRoom\\Http\\Controllers\\GeneralConsultationRoomController@show',
    'permission' => 'general-consultation-room.general-consultation-room.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  462 => 
  array (
    'controller_action' => 'Modules\\GeneralConsultationRoom\\Http\\Controllers\\GeneralConsultationRoomController@store',
    'permission' => 'general-consultation-room.general-consultation-room.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  463 => 
  array (
    'controller_action' => 'Modules\\GeneralConsultationRoom\\Http\\Controllers\\GeneralConsultationRoomController@update',
    'permission' => 'general-consultation-room.general-consultation-room.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  464 => 
  array (
    'controller_action' => 'Modules\\GeneralConsultationRoom\\Http\\Controllers\\GeneralConsultationRoomController@destroy',
    'permission' => 'general-consultation-room.general-consultation-room.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  465 => 
  array (
    'controller_action' => 'Modules\\GeneralContactType\\Http\\Controllers\\ContactTypeController@index',
    'permission' => 'general-contact-type.contact-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  466 => 
  array (
    'controller_action' => 'Modules\\GeneralContactType\\Http\\Controllers\\ContactTypeController@show',
    'permission' => 'general-contact-type.contact-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  467 => 
  array (
    'controller_action' => 'Modules\\GeneralContactType\\Http\\Controllers\\ContactTypeController@store',
    'permission' => 'general-contact-type.contact-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  468 => 
  array (
    'controller_action' => 'Modules\\GeneralContactType\\Http\\Controllers\\ContactTypeController@update',
    'permission' => 'general-contact-type.contact-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  469 => 
  array (
    'controller_action' => 'Modules\\GeneralContactType\\Http\\Controllers\\ContactTypeController@destroy',
    'permission' => 'general-contact-type.contact-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  470 => 
  array (
    'controller_action' => 'Modules\\GeneralCountry\\Http\\Controllers\\CountryController@index',
    'permission' => 'general-country.country.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  471 => 
  array (
    'controller_action' => 'Modules\\GeneralCountry\\Http\\Controllers\\CountryController@show',
    'permission' => 'general-country.country.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  472 => 
  array (
    'controller_action' => 'Modules\\GeneralCountry\\Http\\Controllers\\CountryController@store',
    'permission' => 'general-country.country.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  473 => 
  array (
    'controller_action' => 'Modules\\GeneralCountry\\Http\\Controllers\\CountryController@update',
    'permission' => 'general-country.country.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  474 => 
  array (
    'controller_action' => 'Modules\\GeneralCountry\\Http\\Controllers\\CountryController@destroy',
    'permission' => 'general-country.country.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  475 => 
  array (
    'controller_action' => 'Modules\\GeneralDepositType\\Http\\Controllers\\DepositTypeController@index',
    'permission' => 'general-deposit-type.deposit-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  476 => 
  array (
    'controller_action' => 'Modules\\GeneralDepositType\\Http\\Controllers\\DepositTypeController@show',
    'permission' => 'general-deposit-type.deposit-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  477 => 
  array (
    'controller_action' => 'Modules\\GeneralDepositType\\Http\\Controllers\\DepositTypeController@store',
    'permission' => 'general-deposit-type.deposit-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  478 => 
  array (
    'controller_action' => 'Modules\\GeneralDepositType\\Http\\Controllers\\DepositTypeController@update',
    'permission' => 'general-deposit-type.deposit-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  479 => 
  array (
    'controller_action' => 'Modules\\GeneralDepositType\\Http\\Controllers\\DepositTypeController@destroy',
    'permission' => 'general-deposit-type.deposit-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  480 => 
  array (
    'controller_action' => 'Modules\\GeneralDiagnosisCode\\Http\\Controllers\\DiagnosisCodeController@index',
    'permission' => 'general-diagnosis-code.diagnosis-code.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  481 => 
  array (
    'controller_action' => 'Modules\\GeneralDiagnosisCode\\Http\\Controllers\\DiagnosisCodeController@show',
    'permission' => 'general-diagnosis-code.diagnosis-code.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  482 => 
  array (
    'controller_action' => 'Modules\\GeneralDiagnosisCode\\Http\\Controllers\\DiagnosisCodeController@store',
    'permission' => 'general-diagnosis-code.diagnosis-code.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  483 => 
  array (
    'controller_action' => 'Modules\\GeneralDiagnosisCode\\Http\\Controllers\\DiagnosisCodeController@update',
    'permission' => 'general-diagnosis-code.diagnosis-code.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  484 => 
  array (
    'controller_action' => 'Modules\\GeneralDiagnosisCode\\Http\\Controllers\\DiagnosisCodeController@destroy',
    'permission' => 'general-diagnosis-code.diagnosis-code.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  485 => 
  array (
    'controller_action' => 'Modules\\GeneralDiagnosisRestriction\\Http\\Controllers\\DiagnosisRestrictionController@index',
    'permission' => 'general-diagnosis-restriction.diagnosis-restriction.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  486 => 
  array (
    'controller_action' => 'Modules\\GeneralDiagnosisRestriction\\Http\\Controllers\\DiagnosisRestrictionController@show',
    'permission' => 'general-diagnosis-restriction.diagnosis-restriction.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  487 => 
  array (
    'controller_action' => 'Modules\\GeneralDiagnosisRestriction\\Http\\Controllers\\DiagnosisRestrictionController@store',
    'permission' => 'general-diagnosis-restriction.diagnosis-restriction.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  488 => 
  array (
    'controller_action' => 'Modules\\GeneralDiagnosisRestriction\\Http\\Controllers\\DiagnosisRestrictionController@update',
    'permission' => 'general-diagnosis-restriction.diagnosis-restriction.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  489 => 
  array (
    'controller_action' => 'Modules\\GeneralDiagnosisRestriction\\Http\\Controllers\\DiagnosisRestrictionController@destroy',
    'permission' => 'general-diagnosis-restriction.diagnosis-restriction.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  490 => 
  array (
    'controller_action' => 'Modules\\GeneralDischargeCondition\\Http\\Controllers\\DischargeConditionController@index',
    'permission' => 'general-discharge-condition.discharge-condition.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  491 => 
  array (
    'controller_action' => 'Modules\\GeneralDischargeCondition\\Http\\Controllers\\DischargeConditionController@show',
    'permission' => 'general-discharge-condition.discharge-condition.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  492 => 
  array (
    'controller_action' => 'Modules\\GeneralDischargeCondition\\Http\\Controllers\\DischargeConditionController@store',
    'permission' => 'general-discharge-condition.discharge-condition.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  493 => 
  array (
    'controller_action' => 'Modules\\GeneralDischargeCondition\\Http\\Controllers\\DischargeConditionController@update',
    'permission' => 'general-discharge-condition.discharge-condition.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  494 => 
  array (
    'controller_action' => 'Modules\\GeneralDischargeCondition\\Http\\Controllers\\DischargeConditionController@destroy',
    'permission' => 'general-discharge-condition.discharge-condition.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  495 => 
  array (
    'controller_action' => 'Modules\\GeneralDiscountType\\Http\\Controllers\\DiscountTypeController@index',
    'permission' => 'general-discount-type.discount-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  496 => 
  array (
    'controller_action' => 'Modules\\GeneralDiscountType\\Http\\Controllers\\DiscountTypeController@show',
    'permission' => 'general-discount-type.discount-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  497 => 
  array (
    'controller_action' => 'Modules\\GeneralDiscountType\\Http\\Controllers\\DiscountTypeController@store',
    'permission' => 'general-discount-type.discount-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  498 => 
  array (
    'controller_action' => 'Modules\\GeneralDiscountType\\Http\\Controllers\\DiscountTypeController@update',
    'permission' => 'general-discount-type.discount-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  499 => 
  array (
    'controller_action' => 'Modules\\GeneralDiscountType\\Http\\Controllers\\DiscountTypeController@destroy',
    'permission' => 'general-discount-type.discount-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  500 => 
  array (
    'controller_action' => 'Modules\\GeneralDoctor\\Http\\Controllers\\DoctorController@index',
    'permission' => 'general-doctor.doctor.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  501 => 
  array (
    'controller_action' => 'Modules\\GeneralDoctor\\Http\\Controllers\\DoctorController@show',
    'permission' => 'general-doctor.doctor.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  502 => 
  array (
    'controller_action' => 'Modules\\GeneralDoctor\\Http\\Controllers\\DoctorController@store',
    'permission' => 'general-doctor.doctor.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  503 => 
  array (
    'controller_action' => 'Modules\\GeneralDoctor\\Http\\Controllers\\DoctorController@update',
    'permission' => 'general-doctor.doctor.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  504 => 
  array (
    'controller_action' => 'Modules\\GeneralDoctor\\Http\\Controllers\\DoctorController@destroy',
    'permission' => 'general-doctor.doctor.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  505 => 
  array (
    'controller_action' => 'Modules\\GeneralDoctorMedicalDepartment\\Http\\Controllers\\DoctorMedicalDepartmentController@index',
    'permission' => 'general-doctor-medical-department.doctor-medical-department.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  506 => 
  array (
    'controller_action' => 'Modules\\GeneralDoctorMedicalDepartment\\Http\\Controllers\\DoctorMedicalDepartmentController@show',
    'permission' => 'general-doctor-medical-department.doctor-medical-department.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  507 => 
  array (
    'controller_action' => 'Modules\\GeneralDoctorMedicalDepartment\\Http\\Controllers\\DoctorMedicalDepartmentController@store',
    'permission' => 'general-doctor-medical-department.doctor-medical-department.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  508 => 
  array (
    'controller_action' => 'Modules\\GeneralDoctorMedicalDepartment\\Http\\Controllers\\DoctorMedicalDepartmentController@update',
    'permission' => 'general-doctor-medical-department.doctor-medical-department.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  509 => 
  array (
    'controller_action' => 'Modules\\GeneralDoctorMedicalDepartment\\Http\\Controllers\\DoctorMedicalDepartmentController@destroy',
    'permission' => 'general-doctor-medical-department.doctor-medical-department.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  510 => 
  array (
    'controller_action' => 'Modules\\GeneralDoctorWardAssignment\\Http\\Controllers\\DoctorWardAssignmentController@index',
    'permission' => 'general-doctor-ward-assignment.doctor-ward-assignment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  511 => 
  array (
    'controller_action' => 'Modules\\GeneralDoctorWardAssignment\\Http\\Controllers\\DoctorWardAssignmentController@show',
    'permission' => 'general-doctor-ward-assignment.doctor-ward-assignment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  512 => 
  array (
    'controller_action' => 'Modules\\GeneralDoctorWardAssignment\\Http\\Controllers\\DoctorWardAssignmentController@store',
    'permission' => 'general-doctor-ward-assignment.doctor-ward-assignment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  513 => 
  array (
    'controller_action' => 'Modules\\GeneralDoctorWardAssignment\\Http\\Controllers\\DoctorWardAssignmentController@update',
    'permission' => 'general-doctor-ward-assignment.doctor-ward-assignment.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  514 => 
  array (
    'controller_action' => 'Modules\\GeneralDoctorWardAssignment\\Http\\Controllers\\DoctorWardAssignmentController@destroy',
    'permission' => 'general-doctor-ward-assignment.doctor-ward-assignment.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  515 => 
  array (
    'controller_action' => 'Modules\\GeneralDosageInstruction\\Http\\Controllers\\DosageInstructionController@index',
    'permission' => 'general-dosage-instruction.dosage-instruction.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  516 => 
  array (
    'controller_action' => 'Modules\\GeneralDosageInstruction\\Http\\Controllers\\DosageInstructionController@show',
    'permission' => 'general-dosage-instruction.dosage-instruction.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  517 => 
  array (
    'controller_action' => 'Modules\\GeneralDosageInstruction\\Http\\Controllers\\DosageInstructionController@store',
    'permission' => 'general-dosage-instruction.dosage-instruction.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  518 => 
  array (
    'controller_action' => 'Modules\\GeneralDosageInstruction\\Http\\Controllers\\DosageInstructionController@update',
    'permission' => 'general-dosage-instruction.dosage-instruction.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  519 => 
  array (
    'controller_action' => 'Modules\\GeneralDosageInstruction\\Http\\Controllers\\DosageInstructionController@destroy',
    'permission' => 'general-dosage-instruction.dosage-instruction.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  520 => 
  array (
    'controller_action' => 'Modules\\GeneralDurationRestriction\\Http\\Controllers\\DurationRestrictionController@index',
    'permission' => 'general-duration-restriction.duration-restriction.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  521 => 
  array (
    'controller_action' => 'Modules\\GeneralDurationRestriction\\Http\\Controllers\\DurationRestrictionController@show',
    'permission' => 'general-duration-restriction.duration-restriction.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  522 => 
  array (
    'controller_action' => 'Modules\\GeneralDurationRestriction\\Http\\Controllers\\DurationRestrictionController@store',
    'permission' => 'general-duration-restriction.duration-restriction.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  523 => 
  array (
    'controller_action' => 'Modules\\GeneralDurationRestriction\\Http\\Controllers\\DurationRestrictionController@update',
    'permission' => 'general-duration-restriction.duration-restriction.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  524 => 
  array (
    'controller_action' => 'Modules\\GeneralDurationRestriction\\Http\\Controllers\\DurationRestrictionController@destroy',
    'permission' => 'general-duration-restriction.duration-restriction.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  525 => 
  array (
    'controller_action' => 'Modules\\GeneralEducation\\Http\\Controllers\\EducationController@index',
    'permission' => 'general-education.education.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  526 => 
  array (
    'controller_action' => 'Modules\\GeneralEducation\\Http\\Controllers\\EducationController@show',
    'permission' => 'general-education.education.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  527 => 
  array (
    'controller_action' => 'Modules\\GeneralEducation\\Http\\Controllers\\EducationController@store',
    'permission' => 'general-education.education.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  528 => 
  array (
    'controller_action' => 'Modules\\GeneralEducation\\Http\\Controllers\\EducationController@update',
    'permission' => 'general-education.education.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  529 => 
  array (
    'controller_action' => 'Modules\\GeneralEducation\\Http\\Controllers\\EducationController@destroy',
    'permission' => 'general-education.education.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  530 => 
  array (
    'controller_action' => 'Modules\\GeneralEmployee\\Http\\Controllers\\EmployeeController@index',
    'permission' => 'general-employee.employee.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  531 => 
  array (
    'controller_action' => 'Modules\\GeneralEmployee\\Http\\Controllers\\EmployeeController@show',
    'permission' => 'general-employee.employee.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  532 => 
  array (
    'controller_action' => 'Modules\\GeneralEmployee\\Http\\Controllers\\EmployeeController@store',
    'permission' => 'general-employee.employee.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  533 => 
  array (
    'controller_action' => 'Modules\\GeneralEmployee\\Http\\Controllers\\EmployeeController@update',
    'permission' => 'general-employee.employee.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  534 => 
  array (
    'controller_action' => 'Modules\\GeneralEmployee\\Http\\Controllers\\EmployeeController@destroy',
    'permission' => 'general-employee.employee.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  535 => 
  array (
    'controller_action' => 'Modules\\GeneralEmployeePhoto\\Http\\Controllers\\GeneralEmployeePhotoController@index',
    'permission' => 'general-employee-photo.general-employee-photo.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  536 => 
  array (
    'controller_action' => 'Modules\\GeneralEmployeePhoto\\Http\\Controllers\\GeneralEmployeePhotoController@show',
    'permission' => 'general-employee-photo.general-employee-photo.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  537 => 
  array (
    'controller_action' => 'Modules\\GeneralEmployeePhoto\\Http\\Controllers\\GeneralEmployeePhotoController@store',
    'permission' => 'general-employee-photo.general-employee-photo.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  538 => 
  array (
    'controller_action' => 'Modules\\GeneralEmployeePhoto\\Http\\Controllers\\GeneralEmployeePhotoController@update',
    'permission' => 'general-employee-photo.general-employee-photo.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  539 => 
  array (
    'controller_action' => 'Modules\\GeneralEmployeePhoto\\Http\\Controllers\\GeneralEmployeePhotoController@destroy',
    'permission' => 'general-employee-photo.general-employee-photo.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  540 => 
  array (
    'controller_action' => 'Modules\\GeneralEmployeeStatus\\Http\\Controllers\\EmployeeStatusController@index',
    'permission' => 'general-employee-status.employee-status.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  541 => 
  array (
    'controller_action' => 'Modules\\GeneralEmployeeStatus\\Http\\Controllers\\EmployeeStatusController@show',
    'permission' => 'general-employee-status.employee-status.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  542 => 
  array (
    'controller_action' => 'Modules\\GeneralEmployeeStatus\\Http\\Controllers\\EmployeeStatusController@store',
    'permission' => 'general-employee-status.employee-status.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  543 => 
  array (
    'controller_action' => 'Modules\\GeneralEmployeeStatus\\Http\\Controllers\\EmployeeStatusController@update',
    'permission' => 'general-employee-status.employee-status.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  544 => 
  array (
    'controller_action' => 'Modules\\GeneralEmployeeStatus\\Http\\Controllers\\EmployeeStatusController@destroy',
    'permission' => 'general-employee-status.employee-status.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  545 => 
  array (
    'controller_action' => 'Modules\\GeneralEmploymentStatus\\Http\\Controllers\\EmploymentStatusController@index',
    'permission' => 'general-employment-status.employment-status.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  546 => 
  array (
    'controller_action' => 'Modules\\GeneralEmploymentStatus\\Http\\Controllers\\EmploymentStatusController@show',
    'permission' => 'general-employment-status.employment-status.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  547 => 
  array (
    'controller_action' => 'Modules\\GeneralEmploymentStatus\\Http\\Controllers\\EmploymentStatusController@store',
    'permission' => 'general-employment-status.employment-status.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  548 => 
  array (
    'controller_action' => 'Modules\\GeneralEmploymentStatus\\Http\\Controllers\\EmploymentStatusController@update',
    'permission' => 'general-employment-status.employment-status.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  549 => 
  array (
    'controller_action' => 'Modules\\GeneralEmploymentStatus\\Http\\Controllers\\EmploymentStatusController@destroy',
    'permission' => 'general-employment-status.employment-status.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  550 => 
  array (
    'controller_action' => 'Modules\\GeneralEthnicity\\Http\\Controllers\\EthnicityController@index',
    'permission' => 'general-ethnicity.ethnicity.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  551 => 
  array (
    'controller_action' => 'Modules\\GeneralEthnicity\\Http\\Controllers\\EthnicityController@show',
    'permission' => 'general-ethnicity.ethnicity.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  552 => 
  array (
    'controller_action' => 'Modules\\GeneralEthnicity\\Http\\Controllers\\EthnicityController@store',
    'permission' => 'general-ethnicity.ethnicity.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  553 => 
  array (
    'controller_action' => 'Modules\\GeneralEthnicity\\Http\\Controllers\\EthnicityController@update',
    'permission' => 'general-ethnicity.ethnicity.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  554 => 
  array (
    'controller_action' => 'Modules\\GeneralEthnicity\\Http\\Controllers\\EthnicityController@destroy',
    'permission' => 'general-ethnicity.ethnicity.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  555 => 
  array (
    'controller_action' => 'Modules\\GeneralExaminationGroup\\Http\\Controllers\\ExaminationGroupController@index',
    'permission' => 'general-examination-group.examination-group.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  556 => 
  array (
    'controller_action' => 'Modules\\GeneralExaminationGroup\\Http\\Controllers\\ExaminationGroupController@show',
    'permission' => 'general-examination-group.examination-group.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  557 => 
  array (
    'controller_action' => 'Modules\\GeneralExaminationGroup\\Http\\Controllers\\ExaminationGroupController@store',
    'permission' => 'general-examination-group.examination-group.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  558 => 
  array (
    'controller_action' => 'Modules\\GeneralExaminationGroup\\Http\\Controllers\\ExaminationGroupController@update',
    'permission' => 'general-examination-group.examination-group.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  559 => 
  array (
    'controller_action' => 'Modules\\GeneralExaminationGroup\\Http\\Controllers\\ExaminationGroupController@destroy',
    'permission' => 'general-examination-group.examination-group.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  560 => 
  array (
    'controller_action' => 'Modules\\GeneralExaminationGroupMapping\\Http\\Controllers\\ExaminationGroupMappingController@index',
    'permission' => 'general-examination-group-mapping.examination-group-mapping.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  561 => 
  array (
    'controller_action' => 'Modules\\GeneralExaminationGroupMapping\\Http\\Controllers\\ExaminationGroupMappingController@show',
    'permission' => 'general-examination-group-mapping.examination-group-mapping.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  562 => 
  array (
    'controller_action' => 'Modules\\GeneralExaminationGroupMapping\\Http\\Controllers\\ExaminationGroupMappingController@store',
    'permission' => 'general-examination-group-mapping.examination-group-mapping.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  563 => 
  array (
    'controller_action' => 'Modules\\GeneralExaminationGroupMapping\\Http\\Controllers\\ExaminationGroupMappingController@update',
    'permission' => 'general-examination-group-mapping.examination-group-mapping.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  564 => 
  array (
    'controller_action' => 'Modules\\GeneralExaminationGroupMapping\\Http\\Controllers\\ExaminationGroupMappingController@destroy',
    'permission' => 'general-examination-group-mapping.examination-group-mapping.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  565 => 
  array (
    'controller_action' => 'Modules\\GeneralFacilityMaintenance\\Http\\Controllers\\MaintenanceAssetController@index',
    'permission' => 'general-facility-maintenance.maintenance-asset.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  566 => 
  array (
    'controller_action' => 'Modules\\GeneralFacilityMaintenance\\Http\\Controllers\\MaintenanceAssetController@show',
    'permission' => 'general-facility-maintenance.maintenance-asset.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  567 => 
  array (
    'controller_action' => 'Modules\\GeneralFacilityMaintenance\\Http\\Controllers\\MaintenanceWorkOrderController@index',
    'permission' => 'general-facility-maintenance.maintenance-work-order.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  568 => 
  array (
    'controller_action' => 'Modules\\GeneralFacilityMaintenance\\Http\\Controllers\\MaintenanceWorkOrderController@show',
    'permission' => 'general-facility-maintenance.maintenance-work-order.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  569 => 
  array (
    'controller_action' => 'Modules\\GeneralFacilityMaintenance\\Http\\Controllers\\MaintenanceAssetController@store',
    'permission' => 'general-facility-maintenance.maintenance-asset.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  570 => 
  array (
    'controller_action' => 'Modules\\GeneralFacilityMaintenance\\Http\\Controllers\\MaintenanceAssetController@update',
    'permission' => 'general-facility-maintenance.maintenance-asset.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  571 => 
  array (
    'controller_action' => 'Modules\\GeneralFacilityMaintenance\\Http\\Controllers\\MaintenanceAssetController@destroy',
    'permission' => 'general-facility-maintenance.maintenance-asset.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  572 => 
  array (
    'controller_action' => 'Modules\\GeneralFacilityMaintenance\\Http\\Controllers\\MaintenanceWorkOrderController@store',
    'permission' => 'general-facility-maintenance.maintenance-work-order.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  573 => 
  array (
    'controller_action' => 'Modules\\GeneralFacilityMaintenance\\Http\\Controllers\\MaintenanceWorkOrderController@update',
    'permission' => 'general-facility-maintenance.maintenance-work-order.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  574 => 
  array (
    'controller_action' => 'Modules\\GeneralFacilityMaintenance\\Http\\Controllers\\MaintenanceWorkOrderController@destroy',
    'permission' => 'general-facility-maintenance.maintenance-work-order.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  575 => 
  array (
    'controller_action' => 'Modules\\GeneralFacilityMaintenance\\Http\\Controllers\\MaintenanceWorkOrderController@assign',
    'permission' => 'general-facility-maintenance.maintenance-work-order.assign',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  576 => 
  array (
    'controller_action' => 'Modules\\GeneralFacilityMaintenance\\Http\\Controllers\\MaintenanceWorkOrderController@complete',
    'permission' => 'general-facility-maintenance.maintenance-work-order.complete',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  577 => 
  array (
    'controller_action' => 'Modules\\GeneralFacilityOwnershipType\\Http\\Controllers\\FacilityOwnershipTypeController@index',
    'permission' => 'general-facility-ownership-type.facility-ownership-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  578 => 
  array (
    'controller_action' => 'Modules\\GeneralFacilityOwnershipType\\Http\\Controllers\\FacilityOwnershipTypeController@show',
    'permission' => 'general-facility-ownership-type.facility-ownership-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  579 => 
  array (
    'controller_action' => 'Modules\\GeneralFacilityOwnershipType\\Http\\Controllers\\FacilityOwnershipTypeController@store',
    'permission' => 'general-facility-ownership-type.facility-ownership-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  580 => 
  array (
    'controller_action' => 'Modules\\GeneralFacilityOwnershipType\\Http\\Controllers\\FacilityOwnershipTypeController@update',
    'permission' => 'general-facility-ownership-type.facility-ownership-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  581 => 
  array (
    'controller_action' => 'Modules\\GeneralFacilityOwnershipType\\Http\\Controllers\\FacilityOwnershipTypeController@destroy',
    'permission' => 'general-facility-ownership-type.facility-ownership-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  582 => 
  array (
    'controller_action' => 'Modules\\GeneralFamilyRelationship\\Http\\Controllers\\FamilyRelationshipController@index',
    'permission' => 'general-family-relationship.family-relationship.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  583 => 
  array (
    'controller_action' => 'Modules\\GeneralFamilyRelationship\\Http\\Controllers\\FamilyRelationshipController@show',
    'permission' => 'general-family-relationship.family-relationship.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  584 => 
  array (
    'controller_action' => 'Modules\\GeneralFamilyRelationship\\Http\\Controllers\\FamilyRelationshipController@store',
    'permission' => 'general-family-relationship.family-relationship.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  585 => 
  array (
    'controller_action' => 'Modules\\GeneralFamilyRelationship\\Http\\Controllers\\FamilyRelationshipController@update',
    'permission' => 'general-family-relationship.family-relationship.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  586 => 
  array (
    'controller_action' => 'Modules\\GeneralFamilyRelationship\\Http\\Controllers\\FamilyRelationshipController@destroy',
    'permission' => 'general-family-relationship.family-relationship.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  587 => 
  array (
    'controller_action' => 'Modules\\GeneralFlow\\Http\\Controllers\\FlowController@index',
    'permission' => 'general-flow.flow.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  588 => 
  array (
    'controller_action' => 'Modules\\GeneralFlow\\Http\\Controllers\\FlowController@show',
    'permission' => 'general-flow.flow.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  589 => 
  array (
    'controller_action' => 'Modules\\GeneralFlow\\Http\\Controllers\\FlowController@store',
    'permission' => 'general-flow.flow.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  590 => 
  array (
    'controller_action' => 'Modules\\GeneralFlow\\Http\\Controllers\\FlowController@update',
    'permission' => 'general-flow.flow.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  591 => 
  array (
    'controller_action' => 'Modules\\GeneralFlow\\Http\\Controllers\\FlowController@destroy',
    'permission' => 'general-flow.flow.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  592 => 
  array (
    'controller_action' => 'Modules\\GeneralFormularyRestriction\\Http\\Controllers\\FormularyRestrictionController@index',
    'permission' => 'general-formulary-restriction.formulary-restriction.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  593 => 
  array (
    'controller_action' => 'Modules\\GeneralFormularyRestriction\\Http\\Controllers\\FormularyRestrictionController@show',
    'permission' => 'general-formulary-restriction.formulary-restriction.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  594 => 
  array (
    'controller_action' => 'Modules\\GeneralFormularyRestriction\\Http\\Controllers\\FormularyRestrictionController@store',
    'permission' => 'general-formulary-restriction.formulary-restriction.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  595 => 
  array (
    'controller_action' => 'Modules\\GeneralFormularyRestriction\\Http\\Controllers\\FormularyRestrictionController@update',
    'permission' => 'general-formulary-restriction.formulary-restriction.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  596 => 
  array (
    'controller_action' => 'Modules\\GeneralFormularyRestriction\\Http\\Controllers\\FormularyRestrictionController@destroy',
    'permission' => 'general-formulary-restriction.formulary-restriction.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  597 => 
  array (
    'controller_action' => 'Modules\\GeneralGender\\Http\\Controllers\\GenderController@index',
    'permission' => 'general-gender.gender.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  598 => 
  array (
    'controller_action' => 'Modules\\GeneralGender\\Http\\Controllers\\GenderController@show',
    'permission' => 'general-gender.gender.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  599 => 
  array (
    'controller_action' => 'Modules\\GeneralGender\\Http\\Controllers\\GenderController@store',
    'permission' => 'general-gender.gender.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  600 => 
  array (
    'controller_action' => 'Modules\\GeneralGender\\Http\\Controllers\\GenderController@update',
    'permission' => 'general-gender.gender.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  601 => 
  array (
    'controller_action' => 'Modules\\GeneralGender\\Http\\Controllers\\GenderController@destroy',
    'permission' => 'general-gender.gender.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  602 => 
  array (
    'controller_action' => 'Modules\\GeneralGoodsReceiptCancellationReason\\Http\\Controllers\\GoodsReceiptCancellationReasonController@index',
    'permission' => 'general-goods-receipt-cancellation-reason.goods-receipt-cancellation-reason.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  603 => 
  array (
    'controller_action' => 'Modules\\GeneralGoodsReceiptCancellationReason\\Http\\Controllers\\GoodsReceiptCancellationReasonController@show',
    'permission' => 'general-goods-receipt-cancellation-reason.goods-receipt-cancellation-reason.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  604 => 
  array (
    'controller_action' => 'Modules\\GeneralGoodsReceiptCancellationReason\\Http\\Controllers\\GoodsReceiptCancellationReasonController@store',
    'permission' => 'general-goods-receipt-cancellation-reason.goods-receipt-cancellation-reason.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  605 => 
  array (
    'controller_action' => 'Modules\\GeneralGoodsReceiptCancellationReason\\Http\\Controllers\\GoodsReceiptCancellationReasonController@update',
    'permission' => 'general-goods-receipt-cancellation-reason.goods-receipt-cancellation-reason.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  606 => 
  array (
    'controller_action' => 'Modules\\GeneralGoodsReceiptCancellationReason\\Http\\Controllers\\GoodsReceiptCancellationReasonController@destroy',
    'permission' => 'general-goods-receipt-cancellation-reason.goods-receipt-cancellation-reason.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  607 => 
  array (
    'controller_action' => 'Modules\\GeneralGoodsReceiptType\\Http\\Controllers\\GoodsReceiptTypeController@index',
    'permission' => 'general-goods-receipt-type.goods-receipt-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  608 => 
  array (
    'controller_action' => 'Modules\\GeneralGoodsReceiptType\\Http\\Controllers\\GoodsReceiptTypeController@show',
    'permission' => 'general-goods-receipt-type.goods-receipt-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  609 => 
  array (
    'controller_action' => 'Modules\\GeneralGoodsReceiptType\\Http\\Controllers\\GoodsReceiptTypeController@store',
    'permission' => 'general-goods-receipt-type.goods-receipt-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  610 => 
  array (
    'controller_action' => 'Modules\\GeneralGoodsReceiptType\\Http\\Controllers\\GoodsReceiptTypeController@update',
    'permission' => 'general-goods-receipt-type.goods-receipt-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  611 => 
  array (
    'controller_action' => 'Modules\\GeneralGoodsReceiptType\\Http\\Controllers\\GoodsReceiptTypeController@destroy',
    'permission' => 'general-goods-receipt-type.goods-receipt-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  612 => 
  array (
    'controller_action' => 'Modules\\GeneralGuarantorItemCategoryMapping\\Http\\Controllers\\GuarantorItemCategoryMappingController@index',
    'permission' => 'general-guarantor-item-category-mapping.guarantor-item-category-mapping.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  613 => 
  array (
    'controller_action' => 'Modules\\GeneralGuarantorItemCategoryMapping\\Http\\Controllers\\GuarantorItemCategoryMappingController@show',
    'permission' => 'general-guarantor-item-category-mapping.guarantor-item-category-mapping.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  614 => 
  array (
    'controller_action' => 'Modules\\GeneralGuarantorItemCategoryMapping\\Http\\Controllers\\GuarantorItemCategoryMappingController@store',
    'permission' => 'general-guarantor-item-category-mapping.guarantor-item-category-mapping.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  615 => 
  array (
    'controller_action' => 'Modules\\GeneralGuarantorItemCategoryMapping\\Http\\Controllers\\GuarantorItemCategoryMappingController@update',
    'permission' => 'general-guarantor-item-category-mapping.guarantor-item-category-mapping.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  616 => 
  array (
    'controller_action' => 'Modules\\GeneralGuarantorItemCategoryMapping\\Http\\Controllers\\GuarantorItemCategoryMappingController@destroy',
    'permission' => 'general-guarantor-item-category-mapping.guarantor-item-category-mapping.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  617 => 
  array (
    'controller_action' => 'Modules\\GeneralGuarantorParticipantType\\Http\\Controllers\\GuarantorParticipantTypeController@index',
    'permission' => 'general-guarantor-participant-type.guarantor-participant-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  618 => 
  array (
    'controller_action' => 'Modules\\GeneralGuarantorParticipantType\\Http\\Controllers\\GuarantorParticipantTypeController@show',
    'permission' => 'general-guarantor-participant-type.guarantor-participant-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  619 => 
  array (
    'controller_action' => 'Modules\\GeneralGuarantorParticipantType\\Http\\Controllers\\GuarantorParticipantTypeController@store',
    'permission' => 'general-guarantor-participant-type.guarantor-participant-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  620 => 
  array (
    'controller_action' => 'Modules\\GeneralGuarantorParticipantType\\Http\\Controllers\\GuarantorParticipantTypeController@update',
    'permission' => 'general-guarantor-participant-type.guarantor-participant-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  621 => 
  array (
    'controller_action' => 'Modules\\GeneralGuarantorParticipantType\\Http\\Controllers\\GuarantorParticipantTypeController@destroy',
    'permission' => 'general-guarantor-participant-type.guarantor-participant-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  622 => 
  array (
    'controller_action' => 'Modules\\GeneralGuarantorSubspecialty\\Http\\Controllers\\GuarantorSubspecialtyController@index',
    'permission' => 'general-guarantor-subspecialty.guarantor-subspecialty.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  623 => 
  array (
    'controller_action' => 'Modules\\GeneralGuarantorSubspecialty\\Http\\Controllers\\GuarantorSubspecialtyController@show',
    'permission' => 'general-guarantor-subspecialty.guarantor-subspecialty.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  624 => 
  array (
    'controller_action' => 'Modules\\GeneralGuarantorSubspecialty\\Http\\Controllers\\GuarantorSubspecialtyController@store',
    'permission' => 'general-guarantor-subspecialty.guarantor-subspecialty.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  625 => 
  array (
    'controller_action' => 'Modules\\GeneralGuarantorSubspecialty\\Http\\Controllers\\GuarantorSubspecialtyController@update',
    'permission' => 'general-guarantor-subspecialty.guarantor-subspecialty.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  626 => 
  array (
    'controller_action' => 'Modules\\GeneralGuarantorSubspecialty\\Http\\Controllers\\GuarantorSubspecialtyController@destroy',
    'permission' => 'general-guarantor-subspecialty.guarantor-subspecialty.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  627 => 
  array (
    'controller_action' => 'Modules\\GeneralGuarantorWardAccess\\Http\\Controllers\\GuarantorWardAccessController@index',
    'permission' => 'general-guarantor-ward-access.guarantor-ward-access.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  628 => 
  array (
    'controller_action' => 'Modules\\GeneralGuarantorWardAccess\\Http\\Controllers\\GuarantorWardAccessController@show',
    'permission' => 'general-guarantor-ward-access.guarantor-ward-access.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  629 => 
  array (
    'controller_action' => 'Modules\\GeneralGuarantorWardAccess\\Http\\Controllers\\GuarantorWardAccessController@store',
    'permission' => 'general-guarantor-ward-access.guarantor-ward-access.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  630 => 
  array (
    'controller_action' => 'Modules\\GeneralGuarantorWardAccess\\Http\\Controllers\\GuarantorWardAccessController@update',
    'permission' => 'general-guarantor-ward-access.guarantor-ward-access.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  631 => 
  array (
    'controller_action' => 'Modules\\GeneralGuarantorWardAccess\\Http\\Controllers\\GuarantorWardAccessController@destroy',
    'permission' => 'general-guarantor-ward-access.guarantor-ward-access.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  632 => 
  array (
    'controller_action' => 'Modules\\GeneralHealthProviderType\\Http\\Controllers\\HealthProviderTypeController@index',
    'permission' => 'general-health-provider-type.health-provider-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  633 => 
  array (
    'controller_action' => 'Modules\\GeneralHealthProviderType\\Http\\Controllers\\HealthProviderTypeController@show',
    'permission' => 'general-health-provider-type.health-provider-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  634 => 
  array (
    'controller_action' => 'Modules\\GeneralHealthProviderType\\Http\\Controllers\\HealthProviderTypeController@store',
    'permission' => 'general-health-provider-type.health-provider-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  635 => 
  array (
    'controller_action' => 'Modules\\GeneralHealthProviderType\\Http\\Controllers\\HealthProviderTypeController@update',
    'permission' => 'general-health-provider-type.health-provider-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  636 => 
  array (
    'controller_action' => 'Modules\\GeneralHealthProviderType\\Http\\Controllers\\HealthProviderTypeController@destroy',
    'permission' => 'general-health-provider-type.health-provider-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  637 => 
  array (
    'controller_action' => 'Modules\\GeneralHealthcareServiceType\\Http\\Controllers\\HealthcareServiceTypeController@index',
    'permission' => 'general-healthcare-service-type.healthcare-service-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  638 => 
  array (
    'controller_action' => 'Modules\\GeneralHealthcareServiceType\\Http\\Controllers\\HealthcareServiceTypeController@show',
    'permission' => 'general-healthcare-service-type.healthcare-service-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  639 => 
  array (
    'controller_action' => 'Modules\\GeneralHealthcareServiceType\\Http\\Controllers\\HealthcareServiceTypeController@store',
    'permission' => 'general-healthcare-service-type.healthcare-service-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  640 => 
  array (
    'controller_action' => 'Modules\\GeneralHealthcareServiceType\\Http\\Controllers\\HealthcareServiceTypeController@update',
    'permission' => 'general-healthcare-service-type.healthcare-service-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  641 => 
  array (
    'controller_action' => 'Modules\\GeneralHealthcareServiceType\\Http\\Controllers\\HealthcareServiceTypeController@destroy',
    'permission' => 'general-healthcare-service-type.healthcare-service-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  642 => 
  array (
    'controller_action' => 'Modules\\GeneralIcdOMorphology\\Http\\Controllers\\IcdOMorphologyController@index',
    'permission' => 'general-icd-o-morphology.icd-o-morphology.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  643 => 
  array (
    'controller_action' => 'Modules\\GeneralIcdOMorphology\\Http\\Controllers\\IcdOMorphologyController@show',
    'permission' => 'general-icd-o-morphology.icd-o-morphology.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  644 => 
  array (
    'controller_action' => 'Modules\\GeneralIcdOMorphology\\Http\\Controllers\\IcdOMorphologyController@store',
    'permission' => 'general-icd-o-morphology.icd-o-morphology.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  645 => 
  array (
    'controller_action' => 'Modules\\GeneralIcdOMorphology\\Http\\Controllers\\IcdOMorphologyController@update',
    'permission' => 'general-icd-o-morphology.icd-o-morphology.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  646 => 
  array (
    'controller_action' => 'Modules\\GeneralIcdOMorphology\\Http\\Controllers\\IcdOMorphologyController@destroy',
    'permission' => 'general-icd-o-morphology.icd-o-morphology.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  647 => 
  array (
    'controller_action' => 'Modules\\GeneralIcdOTopography\\Http\\Controllers\\IcdOTopographyController@index',
    'permission' => 'general-icd-o-topography.icd-o-topography.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  648 => 
  array (
    'controller_action' => 'Modules\\GeneralIcdOTopography\\Http\\Controllers\\IcdOTopographyController@show',
    'permission' => 'general-icd-o-topography.icd-o-topography.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  649 => 
  array (
    'controller_action' => 'Modules\\GeneralIcdOTopography\\Http\\Controllers\\IcdOTopographyController@store',
    'permission' => 'general-icd-o-topography.icd-o-topography.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  650 => 
  array (
    'controller_action' => 'Modules\\GeneralIcdOTopography\\Http\\Controllers\\IcdOTopographyController@update',
    'permission' => 'general-icd-o-topography.icd-o-topography.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  651 => 
  array (
    'controller_action' => 'Modules\\GeneralIcdOTopography\\Http\\Controllers\\IcdOTopographyController@destroy',
    'permission' => 'general-icd-o-topography.icd-o-topography.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  652 => 
  array (
    'controller_action' => 'Modules\\GeneralIcdSnomedCtMapping\\Http\\Controllers\\IcdSnomedCtMappingController@index',
    'permission' => 'general-icd-snomed-ct-mapping.icd-snomed-ct-mapping.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  653 => 
  array (
    'controller_action' => 'Modules\\GeneralIcdSnomedCtMapping\\Http\\Controllers\\IcdSnomedCtMappingController@show',
    'permission' => 'general-icd-snomed-ct-mapping.icd-snomed-ct-mapping.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  654 => 
  array (
    'controller_action' => 'Modules\\GeneralIcdSnomedCtMapping\\Http\\Controllers\\IcdSnomedCtMappingController@store',
    'permission' => 'general-icd-snomed-ct-mapping.icd-snomed-ct-mapping.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  655 => 
  array (
    'controller_action' => 'Modules\\GeneralIcdSnomedCtMapping\\Http\\Controllers\\IcdSnomedCtMappingController@update',
    'permission' => 'general-icd-snomed-ct-mapping.icd-snomed-ct-mapping.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  656 => 
  array (
    'controller_action' => 'Modules\\GeneralIcdSnomedCtMapping\\Http\\Controllers\\IcdSnomedCtMappingController@destroy',
    'permission' => 'general-icd-snomed-ct-mapping.icd-snomed-ct-mapping.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  657 => 
  array (
    'controller_action' => 'Modules\\GeneralIcdType\\Http\\Controllers\\IcdTypeController@index',
    'permission' => 'general-icd-type.icd-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  658 => 
  array (
    'controller_action' => 'Modules\\GeneralIcdType\\Http\\Controllers\\IcdTypeController@show',
    'permission' => 'general-icd-type.icd-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  659 => 
  array (
    'controller_action' => 'Modules\\GeneralIcdType\\Http\\Controllers\\IcdTypeController@store',
    'permission' => 'general-icd-type.icd-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  660 => 
  array (
    'controller_action' => 'Modules\\GeneralIcdType\\Http\\Controllers\\IcdTypeController@update',
    'permission' => 'general-icd-type.icd-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  661 => 
  array (
    'controller_action' => 'Modules\\GeneralIcdType\\Http\\Controllers\\IcdTypeController@destroy',
    'permission' => 'general-icd-type.icd-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  662 => 
  array (
    'controller_action' => 'Modules\\GeneralIdentityCardType\\Http\\Controllers\\IdentityCardTypeController@index',
    'permission' => 'general-identity-card-type.identity-card-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  663 => 
  array (
    'controller_action' => 'Modules\\GeneralIdentityCardType\\Http\\Controllers\\IdentityCardTypeController@show',
    'permission' => 'general-identity-card-type.identity-card-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  664 => 
  array (
    'controller_action' => 'Modules\\GeneralIdentityCardType\\Http\\Controllers\\IdentityCardTypeController@store',
    'permission' => 'general-identity-card-type.identity-card-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  665 => 
  array (
    'controller_action' => 'Modules\\GeneralIdentityCardType\\Http\\Controllers\\IdentityCardTypeController@update',
    'permission' => 'general-identity-card-type.identity-card-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  666 => 
  array (
    'controller_action' => 'Modules\\GeneralIdentityCardType\\Http\\Controllers\\IdentityCardTypeController@destroy',
    'permission' => 'general-identity-card-type.identity-card-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  667 => 
  array (
    'controller_action' => 'Modules\\GeneralInpatientType\\Http\\Controllers\\InpatientTypeController@index',
    'permission' => 'general-inpatient-type.inpatient-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  668 => 
  array (
    'controller_action' => 'Modules\\GeneralInpatientType\\Http\\Controllers\\InpatientTypeController@show',
    'permission' => 'general-inpatient-type.inpatient-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  669 => 
  array (
    'controller_action' => 'Modules\\GeneralInpatientType\\Http\\Controllers\\InpatientTypeController@store',
    'permission' => 'general-inpatient-type.inpatient-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  670 => 
  array (
    'controller_action' => 'Modules\\GeneralInpatientType\\Http\\Controllers\\InpatientTypeController@update',
    'permission' => 'general-inpatient-type.inpatient-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  671 => 
  array (
    'controller_action' => 'Modules\\GeneralInpatientType\\Http\\Controllers\\InpatientTypeController@destroy',
    'permission' => 'general-inpatient-type.inpatient-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  672 => 
  array (
    'controller_action' => 'Modules\\GeneralInstitution\\Http\\Controllers\\InstitutionController@index',
    'permission' => 'general-institution.institution.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  673 => 
  array (
    'controller_action' => 'Modules\\GeneralInstitution\\Http\\Controllers\\InstitutionController@show',
    'permission' => 'general-institution.institution.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  674 => 
  array (
    'controller_action' => 'Modules\\GeneralInstitution\\Http\\Controllers\\InstitutionController@store',
    'permission' => 'general-institution.institution.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  675 => 
  array (
    'controller_action' => 'Modules\\GeneralInstitution\\Http\\Controllers\\InstitutionController@update',
    'permission' => 'general-institution.institution.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  676 => 
  array (
    'controller_action' => 'Modules\\GeneralInstitution\\Http\\Controllers\\InstitutionController@destroy',
    'permission' => 'general-institution.institution.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  677 => 
  array (
    'controller_action' => 'Modules\\GeneralInsuranceCardType\\Http\\Controllers\\InsuranceCardTypeController@index',
    'permission' => 'general-insurance-card-type.insurance-card-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  678 => 
  array (
    'controller_action' => 'Modules\\GeneralInsuranceCardType\\Http\\Controllers\\InsuranceCardTypeController@show',
    'permission' => 'general-insurance-card-type.insurance-card-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  679 => 
  array (
    'controller_action' => 'Modules\\GeneralInsuranceCardType\\Http\\Controllers\\InsuranceCardTypeController@store',
    'permission' => 'general-insurance-card-type.insurance-card-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  680 => 
  array (
    'controller_action' => 'Modules\\GeneralInsuranceCardType\\Http\\Controllers\\InsuranceCardTypeController@update',
    'permission' => 'general-insurance-card-type.insurance-card-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  681 => 
  array (
    'controller_action' => 'Modules\\GeneralInsuranceCardType\\Http\\Controllers\\InsuranceCardTypeController@destroy',
    'permission' => 'general-insurance-card-type.insurance-card-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  682 => 
  array (
    'controller_action' => 'Modules\\GeneralInvoiceType\\Http\\Controllers\\InvoiceTypeController@index',
    'permission' => 'general-invoice-type.invoice-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  683 => 
  array (
    'controller_action' => 'Modules\\GeneralInvoiceType\\Http\\Controllers\\InvoiceTypeController@show',
    'permission' => 'general-invoice-type.invoice-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  684 => 
  array (
    'controller_action' => 'Modules\\GeneralInvoiceType\\Http\\Controllers\\InvoiceTypeController@store',
    'permission' => 'general-invoice-type.invoice-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  685 => 
  array (
    'controller_action' => 'Modules\\GeneralInvoiceType\\Http\\Controllers\\InvoiceTypeController@update',
    'permission' => 'general-invoice-type.invoice-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  686 => 
  array (
    'controller_action' => 'Modules\\GeneralInvoiceType\\Http\\Controllers\\InvoiceTypeController@destroy',
    'permission' => 'general-invoice-type.invoice-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  687 => 
  array (
    'controller_action' => 'Modules\\GeneralKap\\Http\\Controllers\\KapController@index',
    'permission' => 'general-kap.kap.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  688 => 
  array (
    'controller_action' => 'Modules\\GeneralKap\\Http\\Controllers\\KapController@show',
    'permission' => 'general-kap.kap.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  689 => 
  array (
    'controller_action' => 'Modules\\GeneralKap\\Http\\Controllers\\KapController@store',
    'permission' => 'general-kap.kap.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  690 => 
  array (
    'controller_action' => 'Modules\\GeneralKap\\Http\\Controllers\\KapController@update',
    'permission' => 'general-kap.kap.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  691 => 
  array (
    'controller_action' => 'Modules\\GeneralKap\\Http\\Controllers\\KapController@destroy',
    'permission' => 'general-kap.kap.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  692 => 
  array (
    'controller_action' => 'Modules\\GeneralKip\\Http\\Controllers\\KipController@index',
    'permission' => 'general-kip.kip.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  693 => 
  array (
    'controller_action' => 'Modules\\GeneralKip\\Http\\Controllers\\KipController@show',
    'permission' => 'general-kip.kip.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  694 => 
  array (
    'controller_action' => 'Modules\\GeneralKip\\Http\\Controllers\\KipController@store',
    'permission' => 'general-kip.kip.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  695 => 
  array (
    'controller_action' => 'Modules\\GeneralKip\\Http\\Controllers\\KipController@update',
    'permission' => 'general-kip.kip.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  696 => 
  array (
    'controller_action' => 'Modules\\GeneralKip\\Http\\Controllers\\KipController@destroy',
    'permission' => 'general-kip.kip.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  697 => 
  array (
    'controller_action' => 'Modules\\GeneralLabGroup\\Http\\Controllers\\LabGroupController@index',
    'permission' => 'general-lab-group.lab-group.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  698 => 
  array (
    'controller_action' => 'Modules\\GeneralLabGroup\\Http\\Controllers\\LabGroupController@show',
    'permission' => 'general-lab-group.lab-group.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  699 => 
  array (
    'controller_action' => 'Modules\\GeneralLabGroup\\Http\\Controllers\\LabGroupController@store',
    'permission' => 'general-lab-group.lab-group.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  700 => 
  array (
    'controller_action' => 'Modules\\GeneralLabGroup\\Http\\Controllers\\LabGroupController@update',
    'permission' => 'general-lab-group.lab-group.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  701 => 
  array (
    'controller_action' => 'Modules\\GeneralLabGroup\\Http\\Controllers\\LabGroupController@destroy',
    'permission' => 'general-lab-group.lab-group.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  702 => 
  array (
    'controller_action' => 'Modules\\GeneralLabReferenceValue\\Http\\Controllers\\LabReferenceValueController@index',
    'permission' => 'general-lab-reference-value.lab-reference-value.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  703 => 
  array (
    'controller_action' => 'Modules\\GeneralLabReferenceValue\\Http\\Controllers\\LabReferenceValueController@show',
    'permission' => 'general-lab-reference-value.lab-reference-value.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  704 => 
  array (
    'controller_action' => 'Modules\\GeneralLabReferenceValue\\Http\\Controllers\\LabReferenceValueController@store',
    'permission' => 'general-lab-reference-value.lab-reference-value.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  705 => 
  array (
    'controller_action' => 'Modules\\GeneralLabReferenceValue\\Http\\Controllers\\LabReferenceValueController@update',
    'permission' => 'general-lab-reference-value.lab-reference-value.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  706 => 
  array (
    'controller_action' => 'Modules\\GeneralLabReferenceValue\\Http\\Controllers\\LabReferenceValueController@destroy',
    'permission' => 'general-lab-reference-value.lab-reference-value.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  707 => 
  array (
    'controller_action' => 'Modules\\GeneralLabServiceGroup\\Http\\Controllers\\LabServiceGroupController@index',
    'permission' => 'general-lab-service-group.lab-service-group.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  708 => 
  array (
    'controller_action' => 'Modules\\GeneralLabServiceGroup\\Http\\Controllers\\LabServiceGroupController@show',
    'permission' => 'general-lab-service-group.lab-service-group.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  709 => 
  array (
    'controller_action' => 'Modules\\GeneralLabServiceGroup\\Http\\Controllers\\LabServiceGroupController@store',
    'permission' => 'general-lab-service-group.lab-service-group.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  710 => 
  array (
    'controller_action' => 'Modules\\GeneralLabServiceGroup\\Http\\Controllers\\LabServiceGroupController@update',
    'permission' => 'general-lab-service-group.lab-service-group.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  711 => 
  array (
    'controller_action' => 'Modules\\GeneralLabServiceGroup\\Http\\Controllers\\LabServiceGroupController@destroy',
    'permission' => 'general-lab-service-group.lab-service-group.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  712 => 
  array (
    'controller_action' => 'Modules\\GeneralLabServiceParameter\\Http\\Controllers\\LabServiceParameterController@index',
    'permission' => 'general-lab-service-parameter.lab-service-parameter.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  713 => 
  array (
    'controller_action' => 'Modules\\GeneralLabServiceParameter\\Http\\Controllers\\LabServiceParameterController@show',
    'permission' => 'general-lab-service-parameter.lab-service-parameter.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  714 => 
  array (
    'controller_action' => 'Modules\\GeneralLabServiceParameter\\Http\\Controllers\\LabServiceParameterController@store',
    'permission' => 'general-lab-service-parameter.lab-service-parameter.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  715 => 
  array (
    'controller_action' => 'Modules\\GeneralLabServiceParameter\\Http\\Controllers\\LabServiceParameterController@update',
    'permission' => 'general-lab-service-parameter.lab-service-parameter.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  716 => 
  array (
    'controller_action' => 'Modules\\GeneralLabServiceParameter\\Http\\Controllers\\LabServiceParameterController@destroy',
    'permission' => 'general-lab-service-parameter.lab-service-parameter.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  717 => 
  array (
    'controller_action' => 'Modules\\GeneralLaboratoryRoom\\Http\\Controllers\\GeneralLaboratoryRoomController@index',
    'permission' => 'general-laboratory-room.general-laboratory-room.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  718 => 
  array (
    'controller_action' => 'Modules\\GeneralLaboratoryRoom\\Http\\Controllers\\GeneralLaboratoryRoomController@show',
    'permission' => 'general-laboratory-room.general-laboratory-room.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  719 => 
  array (
    'controller_action' => 'Modules\\GeneralLaboratoryRoom\\Http\\Controllers\\GeneralLaboratoryRoomController@store',
    'permission' => 'general-laboratory-room.general-laboratory-room.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  720 => 
  array (
    'controller_action' => 'Modules\\GeneralLaboratoryRoom\\Http\\Controllers\\GeneralLaboratoryRoomController@update',
    'permission' => 'general-laboratory-room.general-laboratory-room.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  721 => 
  array (
    'controller_action' => 'Modules\\GeneralLaboratoryRoom\\Http\\Controllers\\GeneralLaboratoryRoomController@destroy',
    'permission' => 'general-laboratory-room.general-laboratory-room.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  722 => 
  array (
    'controller_action' => 'Modules\\GeneralLaboratoryUnit\\Http\\Controllers\\LaboratoryUnitController@index',
    'permission' => 'general-laboratory-unit.laboratory-unit.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  723 => 
  array (
    'controller_action' => 'Modules\\GeneralLaboratoryUnit\\Http\\Controllers\\LaboratoryUnitController@show',
    'permission' => 'general-laboratory-unit.laboratory-unit.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  724 => 
  array (
    'controller_action' => 'Modules\\GeneralLaboratoryUnit\\Http\\Controllers\\LaboratoryUnitController@store',
    'permission' => 'general-laboratory-unit.laboratory-unit.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  725 => 
  array (
    'controller_action' => 'Modules\\GeneralLaboratoryUnit\\Http\\Controllers\\LaboratoryUnitController@update',
    'permission' => 'general-laboratory-unit.laboratory-unit.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  726 => 
  array (
    'controller_action' => 'Modules\\GeneralLaboratoryUnit\\Http\\Controllers\\LaboratoryUnitController@destroy',
    'permission' => 'general-laboratory-unit.laboratory-unit.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  727 => 
  array (
    'controller_action' => 'Modules\\GeneralLanguage\\Http\\Controllers\\LanguageController@index',
    'permission' => 'general-language.language.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  728 => 
  array (
    'controller_action' => 'Modules\\GeneralLanguage\\Http\\Controllers\\LanguageController@show',
    'permission' => 'general-language.language.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  729 => 
  array (
    'controller_action' => 'Modules\\GeneralLanguage\\Http\\Controllers\\LanguageController@store',
    'permission' => 'general-language.language.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  730 => 
  array (
    'controller_action' => 'Modules\\GeneralLanguage\\Http\\Controllers\\LanguageController@update',
    'permission' => 'general-language.language.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  731 => 
  array (
    'controller_action' => 'Modules\\GeneralLanguage\\Http\\Controllers\\LanguageController@destroy',
    'permission' => 'general-language.language.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  732 => 
  array (
    'controller_action' => 'Modules\\GeneralManufacturer\\Http\\Controllers\\ManufacturerController@index',
    'permission' => 'general-manufacturer.manufacturer.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  733 => 
  array (
    'controller_action' => 'Modules\\GeneralManufacturer\\Http\\Controllers\\ManufacturerController@show',
    'permission' => 'general-manufacturer.manufacturer.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  734 => 
  array (
    'controller_action' => 'Modules\\GeneralManufacturer\\Http\\Controllers\\ManufacturerController@store',
    'permission' => 'general-manufacturer.manufacturer.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  735 => 
  array (
    'controller_action' => 'Modules\\GeneralManufacturer\\Http\\Controllers\\ManufacturerController@update',
    'permission' => 'general-manufacturer.manufacturer.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  736 => 
  array (
    'controller_action' => 'Modules\\GeneralManufacturer\\Http\\Controllers\\ManufacturerController@destroy',
    'permission' => 'general-manufacturer.manufacturer.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  737 => 
  array (
    'controller_action' => 'Modules\\GeneralMaritalStatus\\Http\\Controllers\\MaritalStatusController@index',
    'permission' => 'general-marital-status.marital-status.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  738 => 
  array (
    'controller_action' => 'Modules\\GeneralMaritalStatus\\Http\\Controllers\\MaritalStatusController@show',
    'permission' => 'general-marital-status.marital-status.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  739 => 
  array (
    'controller_action' => 'Modules\\GeneralMaritalStatus\\Http\\Controllers\\MaritalStatusController@store',
    'permission' => 'general-marital-status.marital-status.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  740 => 
  array (
    'controller_action' => 'Modules\\GeneralMaritalStatus\\Http\\Controllers\\MaritalStatusController@update',
    'permission' => 'general-marital-status.marital-status.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  741 => 
  array (
    'controller_action' => 'Modules\\GeneralMaritalStatus\\Http\\Controllers\\MaritalStatusController@destroy',
    'permission' => 'general-marital-status.marital-status.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  742 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicalDepartment\\Http\\Controllers\\MedicalDepartmentController@index',
    'permission' => 'general-medical-department.medical-department.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  743 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicalDepartment\\Http\\Controllers\\MedicalDepartmentController@show',
    'permission' => 'general-medical-department.medical-department.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  744 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicalDepartment\\Http\\Controllers\\MedicalDepartmentController@store',
    'permission' => 'general-medical-department.medical-department.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  745 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicalDepartment\\Http\\Controllers\\MedicalDepartmentController@update',
    'permission' => 'general-medical-department.medical-department.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  746 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicalDepartment\\Http\\Controllers\\MedicalDepartmentController@destroy',
    'permission' => 'general-medical-department.medical-department.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  747 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicalDepartmentWardAssignment\\Http\\Controllers\\MedicalDepartmentWardAssignmentController@index',
    'permission' => 'general-medical-department-ward-assignment.medical-department-ward-assignment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  748 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicalDepartmentWardAssignment\\Http\\Controllers\\MedicalDepartmentWardAssignmentController@show',
    'permission' => 'general-medical-department-ward-assignment.medical-department-ward-assignment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  749 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicalDepartmentWardAssignment\\Http\\Controllers\\MedicalDepartmentWardAssignmentController@store',
    'permission' => 'general-medical-department-ward-assignment.medical-department-ward-assignment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  750 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicalDepartmentWardAssignment\\Http\\Controllers\\MedicalDepartmentWardAssignmentController@update',
    'permission' => 'general-medical-department-ward-assignment.medical-department-ward-assignment.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  751 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicalDepartmentWardAssignment\\Http\\Controllers\\MedicalDepartmentWardAssignmentController@destroy',
    'permission' => 'general-medical-department-ward-assignment.medical-department-ward-assignment.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  752 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicalPersonnel\\Http\\Controllers\\MedicalPersonnelController@index',
    'permission' => 'general-medical-personnel.medical-personnel.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  753 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicalPersonnel\\Http\\Controllers\\MedicalPersonnelController@show',
    'permission' => 'general-medical-personnel.medical-personnel.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  754 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicalPersonnel\\Http\\Controllers\\MedicalPersonnelController@store',
    'permission' => 'general-medical-personnel.medical-personnel.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  755 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicalPersonnel\\Http\\Controllers\\MedicalPersonnelController@update',
    'permission' => 'general-medical-personnel.medical-personnel.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  756 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicalPersonnel\\Http\\Controllers\\MedicalPersonnelController@destroy',
    'permission' => 'general-medical-personnel.medical-personnel.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  757 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicalPersonnelType\\Http\\Controllers\\MedicalPersonnelTypeController@index',
    'permission' => 'general-medical-personnel-type.medical-personnel-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  758 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicalPersonnelType\\Http\\Controllers\\MedicalPersonnelTypeController@show',
    'permission' => 'general-medical-personnel-type.medical-personnel-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  759 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicalPersonnelType\\Http\\Controllers\\MedicalPersonnelTypeController@store',
    'permission' => 'general-medical-personnel-type.medical-personnel-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  760 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicalPersonnelType\\Http\\Controllers\\MedicalPersonnelTypeController@update',
    'permission' => 'general-medical-personnel-type.medical-personnel-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  761 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicalPersonnelType\\Http\\Controllers\\MedicalPersonnelTypeController@destroy',
    'permission' => 'general-medical-personnel-type.medical-personnel-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  762 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicationAdministrationType\\Http\\Controllers\\MedicationAdministrationTypeController@index',
    'permission' => 'general-medication-administration-type.medication-administration-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  763 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicationAdministrationType\\Http\\Controllers\\MedicationAdministrationTypeController@show',
    'permission' => 'general-medication-administration-type.medication-administration-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  764 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicationAdministrationType\\Http\\Controllers\\MedicationAdministrationTypeController@store',
    'permission' => 'general-medication-administration-type.medication-administration-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  765 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicationAdministrationType\\Http\\Controllers\\MedicationAdministrationTypeController@update',
    'permission' => 'general-medication-administration-type.medication-administration-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  766 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicationAdministrationType\\Http\\Controllers\\MedicationAdministrationTypeController@destroy',
    'permission' => 'general-medication-administration-type.medication-administration-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  767 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicationUsageType\\Http\\Controllers\\MedicationUsageTypeController@index',
    'permission' => 'general-medication-usage-type.medication-usage-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  768 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicationUsageType\\Http\\Controllers\\MedicationUsageTypeController@show',
    'permission' => 'general-medication-usage-type.medication-usage-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  769 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicationUsageType\\Http\\Controllers\\MedicationUsageTypeController@store',
    'permission' => 'general-medication-usage-type.medication-usage-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  770 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicationUsageType\\Http\\Controllers\\MedicationUsageTypeController@update',
    'permission' => 'general-medication-usage-type.medication-usage-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  771 => 
  array (
    'controller_action' => 'Modules\\GeneralMedicationUsageType\\Http\\Controllers\\MedicationUsageTypeController@destroy',
    'permission' => 'general-medication-usage-type.medication-usage-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  772 => 
  array (
    'controller_action' => 'Modules\\GeneralMixtureInstruction\\Http\\Controllers\\MixtureInstructionController@index',
    'permission' => 'general-mixture-instruction.mixture-instruction.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  773 => 
  array (
    'controller_action' => 'Modules\\GeneralMixtureInstruction\\Http\\Controllers\\MixtureInstructionController@show',
    'permission' => 'general-mixture-instruction.mixture-instruction.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  774 => 
  array (
    'controller_action' => 'Modules\\GeneralMixtureInstruction\\Http\\Controllers\\MixtureInstructionController@store',
    'permission' => 'general-mixture-instruction.mixture-instruction.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  775 => 
  array (
    'controller_action' => 'Modules\\GeneralMixtureInstruction\\Http\\Controllers\\MixtureInstructionController@update',
    'permission' => 'general-mixture-instruction.mixture-instruction.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  776 => 
  array (
    'controller_action' => 'Modules\\GeneralMixtureInstruction\\Http\\Controllers\\MixtureInstructionController@destroy',
    'permission' => 'general-mixture-instruction.mixture-instruction.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  777 => 
  array (
    'controller_action' => 'Modules\\GeneralMixturePackagingType\\Http\\Controllers\\MixturePackagingTypeController@index',
    'permission' => 'general-mixture-packaging-type.mixture-packaging-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  778 => 
  array (
    'controller_action' => 'Modules\\GeneralMixturePackagingType\\Http\\Controllers\\MixturePackagingTypeController@show',
    'permission' => 'general-mixture-packaging-type.mixture-packaging-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  779 => 
  array (
    'controller_action' => 'Modules\\GeneralMixturePackagingType\\Http\\Controllers\\MixturePackagingTypeController@store',
    'permission' => 'general-mixture-packaging-type.mixture-packaging-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  780 => 
  array (
    'controller_action' => 'Modules\\GeneralMixturePackagingType\\Http\\Controllers\\MixturePackagingTypeController@update',
    'permission' => 'general-mixture-packaging-type.mixture-packaging-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  781 => 
  array (
    'controller_action' => 'Modules\\GeneralMixturePackagingType\\Http\\Controllers\\MixturePackagingTypeController@destroy',
    'permission' => 'general-mixture-packaging-type.mixture-packaging-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  782 => 
  array (
    'controller_action' => 'Modules\\GeneralMixtureType\\Http\\Controllers\\MixtureTypeController@index',
    'permission' => 'general-mixture-type.mixture-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  783 => 
  array (
    'controller_action' => 'Modules\\GeneralMixtureType\\Http\\Controllers\\MixtureTypeController@show',
    'permission' => 'general-mixture-type.mixture-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  784 => 
  array (
    'controller_action' => 'Modules\\GeneralMixtureType\\Http\\Controllers\\MixtureTypeController@store',
    'permission' => 'general-mixture-type.mixture-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  785 => 
  array (
    'controller_action' => 'Modules\\GeneralMixtureType\\Http\\Controllers\\MixtureTypeController@update',
    'permission' => 'general-mixture-type.mixture-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  786 => 
  array (
    'controller_action' => 'Modules\\GeneralMixtureType\\Http\\Controllers\\MixtureTypeController@destroy',
    'permission' => 'general-mixture-type.mixture-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  787 => 
  array (
    'controller_action' => 'Modules\\GeneralMonthName\\Http\\Controllers\\MonthNameController@index',
    'permission' => 'general-month-name.month-name.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  788 => 
  array (
    'controller_action' => 'Modules\\GeneralMonthName\\Http\\Controllers\\MonthNameController@show',
    'permission' => 'general-month-name.month-name.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  789 => 
  array (
    'controller_action' => 'Modules\\GeneralMonthName\\Http\\Controllers\\MonthNameController@store',
    'permission' => 'general-month-name.month-name.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  790 => 
  array (
    'controller_action' => 'Modules\\GeneralMonthName\\Http\\Controllers\\MonthNameController@update',
    'permission' => 'general-month-name.month-name.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  791 => 
  array (
    'controller_action' => 'Modules\\GeneralMonthName\\Http\\Controllers\\MonthNameController@destroy',
    'permission' => 'general-month-name.month-name.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  792 => 
  array (
    'controller_action' => 'Modules\\GeneralNurse\\Http\\Controllers\\NurseController@index',
    'permission' => 'general-nurse.nurse.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  793 => 
  array (
    'controller_action' => 'Modules\\GeneralNurse\\Http\\Controllers\\NurseController@show',
    'permission' => 'general-nurse.nurse.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  794 => 
  array (
    'controller_action' => 'Modules\\GeneralNurse\\Http\\Controllers\\NurseController@store',
    'permission' => 'general-nurse.nurse.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  795 => 
  array (
    'controller_action' => 'Modules\\GeneralNurse\\Http\\Controllers\\NurseController@update',
    'permission' => 'general-nurse.nurse.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  796 => 
  array (
    'controller_action' => 'Modules\\GeneralNurse\\Http\\Controllers\\NurseController@destroy',
    'permission' => 'general-nurse.nurse.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  797 => 
  array (
    'controller_action' => 'Modules\\GeneralNurseWardAssignment\\Http\\Controllers\\NurseWardAssignmentController@index',
    'permission' => 'general-nurse-ward-assignment.nurse-ward-assignment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  798 => 
  array (
    'controller_action' => 'Modules\\GeneralNurseWardAssignment\\Http\\Controllers\\NurseWardAssignmentController@show',
    'permission' => 'general-nurse-ward-assignment.nurse-ward-assignment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  799 => 
  array (
    'controller_action' => 'Modules\\GeneralNurseWardAssignment\\Http\\Controllers\\NurseWardAssignmentController@store',
    'permission' => 'general-nurse-ward-assignment.nurse-ward-assignment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  800 => 
  array (
    'controller_action' => 'Modules\\GeneralNurseWardAssignment\\Http\\Controllers\\NurseWardAssignmentController@update',
    'permission' => 'general-nurse-ward-assignment.nurse-ward-assignment.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  801 => 
  array (
    'controller_action' => 'Modules\\GeneralNurseWardAssignment\\Http\\Controllers\\NurseWardAssignmentController@destroy',
    'permission' => 'general-nurse-ward-assignment.nurse-ward-assignment.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  802 => 
  array (
    'controller_action' => 'Modules\\GeneralOccupation\\Http\\Controllers\\OccupationController@index',
    'permission' => 'general-occupation.occupation.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  803 => 
  array (
    'controller_action' => 'Modules\\GeneralOccupation\\Http\\Controllers\\OccupationController@show',
    'permission' => 'general-occupation.occupation.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  804 => 
  array (
    'controller_action' => 'Modules\\GeneralOccupation\\Http\\Controllers\\OccupationController@store',
    'permission' => 'general-occupation.occupation.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  805 => 
  array (
    'controller_action' => 'Modules\\GeneralOccupation\\Http\\Controllers\\OccupationController@update',
    'permission' => 'general-occupation.occupation.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  806 => 
  array (
    'controller_action' => 'Modules\\GeneralOccupation\\Http\\Controllers\\OccupationController@destroy',
    'permission' => 'general-occupation.occupation.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  807 => 
  array (
    'controller_action' => 'Modules\\GeneralOperatingRoom\\Http\\Controllers\\GeneralOperatingRoomController@index',
    'permission' => 'general-operating-room.general-operating-room.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  808 => 
  array (
    'controller_action' => 'Modules\\GeneralOperatingRoom\\Http\\Controllers\\GeneralOperatingRoomController@show',
    'permission' => 'general-operating-room.general-operating-room.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  809 => 
  array (
    'controller_action' => 'Modules\\GeneralOperatingRoom\\Http\\Controllers\\GeneralOperatingRoomController@store',
    'permission' => 'general-operating-room.general-operating-room.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  810 => 
  array (
    'controller_action' => 'Modules\\GeneralOperatingRoom\\Http\\Controllers\\GeneralOperatingRoomController@update',
    'permission' => 'general-operating-room.general-operating-room.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  811 => 
  array (
    'controller_action' => 'Modules\\GeneralOperatingRoom\\Http\\Controllers\\GeneralOperatingRoomController@destroy',
    'permission' => 'general-operating-room.general-operating-room.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  812 => 
  array (
    'controller_action' => 'Modules\\GeneralOperationClass\\Http\\Controllers\\OperationClassController@index',
    'permission' => 'general-operation-class.operation-class.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  813 => 
  array (
    'controller_action' => 'Modules\\GeneralOperationClass\\Http\\Controllers\\OperationClassController@show',
    'permission' => 'general-operation-class.operation-class.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  814 => 
  array (
    'controller_action' => 'Modules\\GeneralOperationClass\\Http\\Controllers\\OperationClassController@store',
    'permission' => 'general-operation-class.operation-class.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  815 => 
  array (
    'controller_action' => 'Modules\\GeneralOperationClass\\Http\\Controllers\\OperationClassController@update',
    'permission' => 'general-operation-class.operation-class.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  816 => 
  array (
    'controller_action' => 'Modules\\GeneralOperationClass\\Http\\Controllers\\OperationClassController@destroy',
    'permission' => 'general-operation-class.operation-class.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  817 => 
  array (
    'controller_action' => 'Modules\\GeneralOperationGroup\\Http\\Controllers\\OperationGroupController@index',
    'permission' => 'general-operation-group.operation-group.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  818 => 
  array (
    'controller_action' => 'Modules\\GeneralOperationGroup\\Http\\Controllers\\OperationGroupController@show',
    'permission' => 'general-operation-group.operation-group.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  819 => 
  array (
    'controller_action' => 'Modules\\GeneralOperationGroup\\Http\\Controllers\\OperationGroupController@store',
    'permission' => 'general-operation-group.operation-group.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  820 => 
  array (
    'controller_action' => 'Modules\\GeneralOperationGroup\\Http\\Controllers\\OperationGroupController@update',
    'permission' => 'general-operation-group.operation-group.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  821 => 
  array (
    'controller_action' => 'Modules\\GeneralOperationGroup\\Http\\Controllers\\OperationGroupController@destroy',
    'permission' => 'general-operation-group.operation-group.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  822 => 
  array (
    'controller_action' => 'Modules\\GeneralOperationType\\Http\\Controllers\\OperationTypeController@index',
    'permission' => 'general-operation-type.operation-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  823 => 
  array (
    'controller_action' => 'Modules\\GeneralOperationType\\Http\\Controllers\\OperationTypeController@show',
    'permission' => 'general-operation-type.operation-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  824 => 
  array (
    'controller_action' => 'Modules\\GeneralOperationType\\Http\\Controllers\\OperationTypeController@store',
    'permission' => 'general-operation-type.operation-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  825 => 
  array (
    'controller_action' => 'Modules\\GeneralOperationType\\Http\\Controllers\\OperationTypeController@update',
    'permission' => 'general-operation-type.operation-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  826 => 
  array (
    'controller_action' => 'Modules\\GeneralOperationType\\Http\\Controllers\\OperationTypeController@destroy',
    'permission' => 'general-operation-type.operation-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  827 => 
  array (
    'controller_action' => 'Modules\\GeneralOtherService\\Http\\Controllers\\OtherServiceController@index',
    'permission' => 'general-other-service.other-service.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  828 => 
  array (
    'controller_action' => 'Modules\\GeneralOtherService\\Http\\Controllers\\OtherServiceController@show',
    'permission' => 'general-other-service.other-service.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  829 => 
  array (
    'controller_action' => 'Modules\\GeneralOtherService\\Http\\Controllers\\OtherServiceController@store',
    'permission' => 'general-other-service.other-service.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  830 => 
  array (
    'controller_action' => 'Modules\\GeneralOtherService\\Http\\Controllers\\OtherServiceController@update',
    'permission' => 'general-other-service.other-service.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  831 => 
  array (
    'controller_action' => 'Modules\\GeneralOtherService\\Http\\Controllers\\OtherServiceController@destroy',
    'permission' => 'general-other-service.other-service.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  832 => 
  array (
    'controller_action' => 'Modules\\GeneralOtherServiceTariff\\Http\\Controllers\\OtherServiceTariffController@index',
    'permission' => 'general-other-service-tariff.other-service-tariff.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  833 => 
  array (
    'controller_action' => 'Modules\\GeneralOtherServiceTariff\\Http\\Controllers\\OtherServiceTariffController@show',
    'permission' => 'general-other-service-tariff.other-service-tariff.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  834 => 
  array (
    'controller_action' => 'Modules\\GeneralOtherServiceTariff\\Http\\Controllers\\OtherServiceTariffController@store',
    'permission' => 'general-other-service-tariff.other-service-tariff.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  835 => 
  array (
    'controller_action' => 'Modules\\GeneralOtherServiceTariff\\Http\\Controllers\\OtherServiceTariffController@update',
    'permission' => 'general-other-service-tariff.other-service-tariff.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  836 => 
  array (
    'controller_action' => 'Modules\\GeneralOtherServiceTariff\\Http\\Controllers\\OtherServiceTariffController@destroy',
    'permission' => 'general-other-service-tariff.other-service-tariff.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  837 => 
  array (
    'controller_action' => 'Modules\\GeneralOtherStatus\\Http\\Controllers\\OtherStatusController@index',
    'permission' => 'general-other-status.other-status.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  838 => 
  array (
    'controller_action' => 'Modules\\GeneralOtherStatus\\Http\\Controllers\\OtherStatusController@show',
    'permission' => 'general-other-status.other-status.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  839 => 
  array (
    'controller_action' => 'Modules\\GeneralOtherStatus\\Http\\Controllers\\OtherStatusController@store',
    'permission' => 'general-other-status.other-status.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  840 => 
  array (
    'controller_action' => 'Modules\\GeneralOtherStatus\\Http\\Controllers\\OtherStatusController@update',
    'permission' => 'general-other-status.other-status.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  841 => 
  array (
    'controller_action' => 'Modules\\GeneralOtherStatus\\Http\\Controllers\\OtherStatusController@destroy',
    'permission' => 'general-other-status.other-status.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  842 => 
  array (
    'controller_action' => 'Modules\\GeneralOxygenTariff\\Http\\Controllers\\OxygenTariffController@index',
    'permission' => 'general-oxygen-tariff.oxygen-tariff.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  843 => 
  array (
    'controller_action' => 'Modules\\GeneralOxygenTariff\\Http\\Controllers\\OxygenTariffController@show',
    'permission' => 'general-oxygen-tariff.oxygen-tariff.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  844 => 
  array (
    'controller_action' => 'Modules\\GeneralOxygenTariff\\Http\\Controllers\\OxygenTariffController@store',
    'permission' => 'general-oxygen-tariff.oxygen-tariff.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  845 => 
  array (
    'controller_action' => 'Modules\\GeneralOxygenTariff\\Http\\Controllers\\OxygenTariffController@update',
    'permission' => 'general-oxygen-tariff.oxygen-tariff.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  846 => 
  array (
    'controller_action' => 'Modules\\GeneralOxygenTariff\\Http\\Controllers\\OxygenTariffController@destroy',
    'permission' => 'general-oxygen-tariff.oxygen-tariff.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  847 => 
  array (
    'controller_action' => 'Modules\\GeneralPackage\\Http\\Controllers\\PackageController@index',
    'permission' => 'general-package.package.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  848 => 
  array (
    'controller_action' => 'Modules\\GeneralPackage\\Http\\Controllers\\PackageController@show',
    'permission' => 'general-package.package.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  849 => 
  array (
    'controller_action' => 'Modules\\GeneralPackage\\Http\\Controllers\\PackageController@store',
    'permission' => 'general-package.package.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  850 => 
  array (
    'controller_action' => 'Modules\\GeneralPackage\\Http\\Controllers\\PackageController@update',
    'permission' => 'general-package.package.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  851 => 
  array (
    'controller_action' => 'Modules\\GeneralPackage\\Http\\Controllers\\PackageController@destroy',
    'permission' => 'general-package.package.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  852 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageItem\\Http\\Controllers\\PackageItemController@index',
    'permission' => 'general-package-item.package-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  853 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageItem\\Http\\Controllers\\PackageItemController@show',
    'permission' => 'general-package-item.package-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  854 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageItem\\Http\\Controllers\\PackageItemController@store',
    'permission' => 'general-package-item.package-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  855 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageItem\\Http\\Controllers\\PackageItemController@update',
    'permission' => 'general-package-item.package-item.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  856 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageItem\\Http\\Controllers\\PackageItemController@destroy',
    'permission' => 'general-package-item.package-item.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  857 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageItemType\\Http\\Controllers\\PackageItemTypeController@index',
    'permission' => 'general-package-item-type.package-item-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  858 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageItemType\\Http\\Controllers\\PackageItemTypeController@show',
    'permission' => 'general-package-item-type.package-item-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  859 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageItemType\\Http\\Controllers\\PackageItemTypeController@store',
    'permission' => 'general-package-item-type.package-item-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  860 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageItemType\\Http\\Controllers\\PackageItemTypeController@update',
    'permission' => 'general-package-item-type.package-item-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  861 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageItemType\\Http\\Controllers\\PackageItemTypeController@destroy',
    'permission' => 'general-package-item-type.package-item-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  862 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageService\\Http\\Controllers\\PackageServiceController@index',
    'permission' => 'general-package-service.package-service.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  863 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageService\\Http\\Controllers\\PackageServiceController@show',
    'permission' => 'general-package-service.package-service.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  864 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageService\\Http\\Controllers\\PackageServiceController@store',
    'permission' => 'general-package-service.package-service.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  865 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageService\\Http\\Controllers\\PackageServiceController@update',
    'permission' => 'general-package-service.package-service.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  866 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageService\\Http\\Controllers\\PackageServiceController@destroy',
    'permission' => 'general-package-service.package-service.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  867 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageTariffDistribution\\Http\\Controllers\\PackageTariffDistributionController@index',
    'permission' => 'general-package-tariff-distribution.package-tariff-distribution.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  868 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageTariffDistribution\\Http\\Controllers\\PackageTariffDistributionController@show',
    'permission' => 'general-package-tariff-distribution.package-tariff-distribution.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  869 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageTariffDistribution\\Http\\Controllers\\PackageTariffDistributionController@store',
    'permission' => 'general-package-tariff-distribution.package-tariff-distribution.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  870 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageTariffDistribution\\Http\\Controllers\\PackageTariffDistributionController@update',
    'permission' => 'general-package-tariff-distribution.package-tariff-distribution.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  871 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageTariffDistribution\\Http\\Controllers\\PackageTariffDistributionController@destroy',
    'permission' => 'general-package-tariff-distribution.package-tariff-distribution.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  872 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageTariffDistributionItem\\Http\\Controllers\\PackageTariffDistributionItemController@index',
    'permission' => 'general-package-tariff-distribution-item.package-tariff-distribution-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  873 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageTariffDistributionItem\\Http\\Controllers\\PackageTariffDistributionItemController@show',
    'permission' => 'general-package-tariff-distribution-item.package-tariff-distribution-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  874 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageTariffDistributionItem\\Http\\Controllers\\PackageTariffDistributionItemController@store',
    'permission' => 'general-package-tariff-distribution-item.package-tariff-distribution-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  875 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageTariffDistributionItem\\Http\\Controllers\\PackageTariffDistributionItemController@update',
    'permission' => 'general-package-tariff-distribution-item.package-tariff-distribution-item.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  876 => 
  array (
    'controller_action' => 'Modules\\GeneralPackageTariffDistributionItem\\Http\\Controllers\\PackageTariffDistributionItemController@destroy',
    'permission' => 'general-package-tariff-distribution-item.package-tariff-distribution-item.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  877 => 
  array (
    'controller_action' => 'Modules\\GeneralPainOnsetType\\Http\\Controllers\\PainOnsetTypeController@index',
    'permission' => 'general-pain-onset-type.pain-onset-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  878 => 
  array (
    'controller_action' => 'Modules\\GeneralPainOnsetType\\Http\\Controllers\\PainOnsetTypeController@show',
    'permission' => 'general-pain-onset-type.pain-onset-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  879 => 
  array (
    'controller_action' => 'Modules\\GeneralPainOnsetType\\Http\\Controllers\\PainOnsetTypeController@store',
    'permission' => 'general-pain-onset-type.pain-onset-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  880 => 
  array (
    'controller_action' => 'Modules\\GeneralPainOnsetType\\Http\\Controllers\\PainOnsetTypeController@update',
    'permission' => 'general-pain-onset-type.pain-onset-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  881 => 
  array (
    'controller_action' => 'Modules\\GeneralPainOnsetType\\Http\\Controllers\\PainOnsetTypeController@destroy',
    'permission' => 'general-pain-onset-type.pain-onset-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  882 => 
  array (
    'controller_action' => 'Modules\\GeneralPainScaleMethod\\Http\\Controllers\\PainScaleMethodController@index',
    'permission' => 'general-pain-scale-method.pain-scale-method.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  883 => 
  array (
    'controller_action' => 'Modules\\GeneralPainScaleMethod\\Http\\Controllers\\PainScaleMethodController@show',
    'permission' => 'general-pain-scale-method.pain-scale-method.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  884 => 
  array (
    'controller_action' => 'Modules\\GeneralPainScaleMethod\\Http\\Controllers\\PainScaleMethodController@store',
    'permission' => 'general-pain-scale-method.pain-scale-method.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  885 => 
  array (
    'controller_action' => 'Modules\\GeneralPainScaleMethod\\Http\\Controllers\\PainScaleMethodController@update',
    'permission' => 'general-pain-scale-method.pain-scale-method.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  886 => 
  array (
    'controller_action' => 'Modules\\GeneralPainScaleMethod\\Http\\Controllers\\PainScaleMethodController@destroy',
    'permission' => 'general-pain-scale-method.pain-scale-method.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  887 => 
  array (
    'controller_action' => 'Modules\\GeneralPathologyExaminationType\\Http\\Controllers\\PathologyExaminationTypeController@index',
    'permission' => 'general-pathology-examination-type.pathology-examination-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  888 => 
  array (
    'controller_action' => 'Modules\\GeneralPathologyExaminationType\\Http\\Controllers\\PathologyExaminationTypeController@show',
    'permission' => 'general-pathology-examination-type.pathology-examination-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  889 => 
  array (
    'controller_action' => 'Modules\\GeneralPathologyExaminationType\\Http\\Controllers\\PathologyExaminationTypeController@store',
    'permission' => 'general-pathology-examination-type.pathology-examination-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  890 => 
  array (
    'controller_action' => 'Modules\\GeneralPathologyExaminationType\\Http\\Controllers\\PathologyExaminationTypeController@update',
    'permission' => 'general-pathology-examination-type.pathology-examination-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  891 => 
  array (
    'controller_action' => 'Modules\\GeneralPathologyExaminationType\\Http\\Controllers\\PathologyExaminationTypeController@destroy',
    'permission' => 'general-pathology-examination-type.pathology-examination-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  892 => 
  array (
    'controller_action' => 'Modules\\GeneralPatient\\Http\\Controllers\\PatientController@search',
    'permission' => 'general-patient.patient.search',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  893 => 
  array (
    'controller_action' => 'Modules\\GeneralPatient\\Http\\Controllers\\PatientController@index',
    'permission' => 'general-patient.patient.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  894 => 
  array (
    'controller_action' => 'Modules\\GeneralPatient\\Http\\Controllers\\PatientController@show',
    'permission' => 'general-patient.patient.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  895 => 
  array (
    'controller_action' => 'Modules\\GeneralPatient\\Http\\Controllers\\PatientController@store',
    'permission' => 'general-patient.patient.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  896 => 
  array (
    'controller_action' => 'Modules\\GeneralPatient\\Http\\Controllers\\PatientController@update',
    'permission' => 'general-patient.patient.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  897 => 
  array (
    'controller_action' => 'Modules\\GeneralPatient\\Http\\Controllers\\PatientController@destroy',
    'permission' => 'general-patient.patient.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  898 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientAccessLock\\Http\\Controllers\\PatientAccessLockController@index',
    'permission' => 'general-patient-access-lock.patient-access-lock.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  899 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientAccessLock\\Http\\Controllers\\PatientAccessLockController@show',
    'permission' => 'general-patient-access-lock.patient-access-lock.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  900 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientAccessLock\\Http\\Controllers\\PatientAccessLockController@store',
    'permission' => 'general-patient-access-lock.patient-access-lock.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  901 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientAccessLock\\Http\\Controllers\\PatientAccessLockController@update',
    'permission' => 'general-patient-access-lock.patient-access-lock.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  902 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientAccessLock\\Http\\Controllers\\PatientAccessLockController@destroy',
    'permission' => 'general-patient-access-lock.patient-access-lock.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  903 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientContact\\Http\\Controllers\\PatientContactController@index',
    'permission' => 'general-patient-contact.patient-contact.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  904 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientContact\\Http\\Controllers\\PatientContactController@show',
    'permission' => 'general-patient-contact.patient-contact.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  905 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientContact\\Http\\Controllers\\PatientContactController@store',
    'permission' => 'general-patient-contact.patient-contact.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  906 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientContact\\Http\\Controllers\\PatientContactController@update',
    'permission' => 'general-patient-contact.patient-contact.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  907 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientContact\\Http\\Controllers\\PatientContactController@destroy',
    'permission' => 'general-patient-contact.patient-contact.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  908 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientFamily\\Http\\Controllers\\PatientFamilyController@index',
    'permission' => 'general-patient-family.patient-family.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  909 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientFamily\\Http\\Controllers\\PatientFamilyController@show',
    'permission' => 'general-patient-family.patient-family.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  910 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientFamily\\Http\\Controllers\\PatientFamilyController@store',
    'permission' => 'general-patient-family.patient-family.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  911 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientFamily\\Http\\Controllers\\PatientFamilyController@update',
    'permission' => 'general-patient-family.patient-family.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  912 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientFamily\\Http\\Controllers\\PatientFamilyController@destroy',
    'permission' => 'general-patient-family.patient-family.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  913 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientFamilyContact\\Http\\Controllers\\PatientFamilyContactController@index',
    'permission' => 'general-patient-family-contact.patient-family-contact.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  914 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientFamilyContact\\Http\\Controllers\\PatientFamilyContactController@show',
    'permission' => 'general-patient-family-contact.patient-family-contact.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  915 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientFamilyContact\\Http\\Controllers\\PatientFamilyContactController@store',
    'permission' => 'general-patient-family-contact.patient-family-contact.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  916 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientFamilyContact\\Http\\Controllers\\PatientFamilyContactController@update',
    'permission' => 'general-patient-family-contact.patient-family-contact.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  917 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientFamilyContact\\Http\\Controllers\\PatientFamilyContactController@destroy',
    'permission' => 'general-patient-family-contact.patient-family-contact.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  918 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientFamilyIdentityCard\\Http\\Controllers\\PatientFamilyIdentityCardController@index',
    'permission' => 'general-patient-family-identity-card.patient-family-identity-card.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  919 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientFamilyIdentityCard\\Http\\Controllers\\PatientFamilyIdentityCardController@show',
    'permission' => 'general-patient-family-identity-card.patient-family-identity-card.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  920 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientFamilyIdentityCard\\Http\\Controllers\\PatientFamilyIdentityCardController@store',
    'permission' => 'general-patient-family-identity-card.patient-family-identity-card.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  921 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientFamilyIdentityCard\\Http\\Controllers\\PatientFamilyIdentityCardController@update',
    'permission' => 'general-patient-family-identity-card.patient-family-identity-card.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  922 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientFamilyIdentityCard\\Http\\Controllers\\PatientFamilyIdentityCardController@destroy',
    'permission' => 'general-patient-family-identity-card.patient-family-identity-card.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  923 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientIdentityCard\\Http\\Controllers\\PatientIdentityCardController@index',
    'permission' => 'general-patient-identity-card.patient-identity-card.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  924 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientIdentityCard\\Http\\Controllers\\PatientIdentityCardController@show',
    'permission' => 'general-patient-identity-card.patient-identity-card.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  925 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientIdentityCard\\Http\\Controllers\\PatientIdentityCardController@store',
    'permission' => 'general-patient-identity-card.patient-identity-card.store',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  926 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientIdentityCard\\Http\\Controllers\\PatientIdentityCardController@update',
    'permission' => 'general-patient-identity-card.patient-identity-card.update',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  927 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientIdentityCard\\Http\\Controllers\\PatientIdentityCardController@destroy',
    'permission' => 'general-patient-identity-card.patient-identity-card.destroy',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  928 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientPhoto\\Http\\Controllers\\GeneralPatientPhotoController@index',
    'permission' => 'general-patient-photo.general-patient-photo.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  929 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientPhoto\\Http\\Controllers\\GeneralPatientPhotoController@show',
    'permission' => 'general-patient-photo.general-patient-photo.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  930 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientPhoto\\Http\\Controllers\\GeneralPatientPhotoController@store',
    'permission' => 'general-patient-photo.general-patient-photo.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  931 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientPhoto\\Http\\Controllers\\GeneralPatientPhotoController@update',
    'permission' => 'general-patient-photo.general-patient-photo.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  932 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientPhoto\\Http\\Controllers\\GeneralPatientPhotoController@destroy',
    'permission' => 'general-patient-photo.general-patient-photo.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  933 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientPickupStatus\\Http\\Controllers\\PatientPickupStatusController@index',
    'permission' => 'general-patient-pickup-status.patient-pickup-status.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  934 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientPickupStatus\\Http\\Controllers\\PatientPickupStatusController@show',
    'permission' => 'general-patient-pickup-status.patient-pickup-status.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  935 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientPickupStatus\\Http\\Controllers\\PatientPickupStatusController@store',
    'permission' => 'general-patient-pickup-status.patient-pickup-status.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  936 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientPickupStatus\\Http\\Controllers\\PatientPickupStatusController@update',
    'permission' => 'general-patient-pickup-status.patient-pickup-status.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  937 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientPickupStatus\\Http\\Controllers\\PatientPickupStatusController@destroy',
    'permission' => 'general-patient-pickup-status.patient-pickup-status.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  938 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientStatus\\Http\\Controllers\\PatientStatusController@index',
    'permission' => 'general-patient-status.patient-status.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  939 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientStatus\\Http\\Controllers\\PatientStatusController@show',
    'permission' => 'general-patient-status.patient-status.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  940 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientStatus\\Http\\Controllers\\PatientStatusController@store',
    'permission' => 'general-patient-status.patient-status.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  941 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientStatus\\Http\\Controllers\\PatientStatusController@update',
    'permission' => 'general-patient-status.patient-status.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  942 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientStatus\\Http\\Controllers\\PatientStatusController@destroy',
    'permission' => 'general-patient-status.patient-status.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  943 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientType\\Http\\Controllers\\PatientTypeController@index',
    'permission' => 'general-patient-type.patient-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  944 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientType\\Http\\Controllers\\PatientTypeController@show',
    'permission' => 'general-patient-type.patient-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  945 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientType\\Http\\Controllers\\PatientTypeController@store',
    'permission' => 'general-patient-type.patient-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  946 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientType\\Http\\Controllers\\PatientTypeController@update',
    'permission' => 'general-patient-type.patient-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  947 => 
  array (
    'controller_action' => 'Modules\\GeneralPatientType\\Http\\Controllers\\PatientTypeController@destroy',
    'permission' => 'general-patient-type.patient-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  948 => 
  array (
    'controller_action' => 'Modules\\GeneralPaymentTransactionType\\Http\\Controllers\\PaymentTransactionTypeController@index',
    'permission' => 'general-payment-transaction-type.payment-transaction-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  949 => 
  array (
    'controller_action' => 'Modules\\GeneralPaymentTransactionType\\Http\\Controllers\\PaymentTransactionTypeController@show',
    'permission' => 'general-payment-transaction-type.payment-transaction-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  950 => 
  array (
    'controller_action' => 'Modules\\GeneralPaymentTransactionType\\Http\\Controllers\\PaymentTransactionTypeController@store',
    'permission' => 'general-payment-transaction-type.payment-transaction-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  951 => 
  array (
    'controller_action' => 'Modules\\GeneralPaymentTransactionType\\Http\\Controllers\\PaymentTransactionTypeController@update',
    'permission' => 'general-payment-transaction-type.payment-transaction-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  952 => 
  array (
    'controller_action' => 'Modules\\GeneralPaymentTransactionType\\Http\\Controllers\\PaymentTransactionTypeController@destroy',
    'permission' => 'general-payment-transaction-type.payment-transaction-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  953 => 
  array (
    'controller_action' => 'Modules\\GeneralPaymentType\\Http\\Controllers\\PaymentTypeController@index',
    'permission' => 'general-payment-type.payment-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  954 => 
  array (
    'controller_action' => 'Modules\\GeneralPaymentType\\Http\\Controllers\\PaymentTypeController@show',
    'permission' => 'general-payment-type.payment-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  955 => 
  array (
    'controller_action' => 'Modules\\GeneralPaymentType\\Http\\Controllers\\PaymentTypeController@store',
    'permission' => 'general-payment-type.payment-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  956 => 
  array (
    'controller_action' => 'Modules\\GeneralPaymentType\\Http\\Controllers\\PaymentTypeController@update',
    'permission' => 'general-payment-type.payment-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  957 => 
  array (
    'controller_action' => 'Modules\\GeneralPaymentType\\Http\\Controllers\\PaymentTypeController@destroy',
    'permission' => 'general-payment-type.payment-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  958 => 
  array (
    'controller_action' => 'Modules\\GeneralPayrollAddition\\Http\\Controllers\\PayrollAdditionController@index',
    'permission' => 'general-payroll-addition.payroll-addition.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  959 => 
  array (
    'controller_action' => 'Modules\\GeneralPayrollAddition\\Http\\Controllers\\PayrollAdditionController@show',
    'permission' => 'general-payroll-addition.payroll-addition.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  960 => 
  array (
    'controller_action' => 'Modules\\GeneralPayrollAddition\\Http\\Controllers\\PayrollAdditionController@store',
    'permission' => 'general-payroll-addition.payroll-addition.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  961 => 
  array (
    'controller_action' => 'Modules\\GeneralPayrollAddition\\Http\\Controllers\\PayrollAdditionController@update',
    'permission' => 'general-payroll-addition.payroll-addition.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  962 => 
  array (
    'controller_action' => 'Modules\\GeneralPayrollAddition\\Http\\Controllers\\PayrollAdditionController@destroy',
    'permission' => 'general-payroll-addition.payroll-addition.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  963 => 
  array (
    'controller_action' => 'Modules\\GeneralPayrollDeduction\\Http\\Controllers\\PayrollDeductionController@index',
    'permission' => 'general-payroll-deduction.payroll-deduction.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  964 => 
  array (
    'controller_action' => 'Modules\\GeneralPayrollDeduction\\Http\\Controllers\\PayrollDeductionController@show',
    'permission' => 'general-payroll-deduction.payroll-deduction.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  965 => 
  array (
    'controller_action' => 'Modules\\GeneralPayrollDeduction\\Http\\Controllers\\PayrollDeductionController@store',
    'permission' => 'general-payroll-deduction.payroll-deduction.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  966 => 
  array (
    'controller_action' => 'Modules\\GeneralPayrollDeduction\\Http\\Controllers\\PayrollDeductionController@update',
    'permission' => 'general-payroll-deduction.payroll-deduction.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  967 => 
  array (
    'controller_action' => 'Modules\\GeneralPayrollDeduction\\Http\\Controllers\\PayrollDeductionController@destroy',
    'permission' => 'general-payroll-deduction.payroll-deduction.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  968 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyDepot\\Http\\Controllers\\PharmacyDepotController@index',
    'permission' => 'general-pharmacy-depot.pharmacy-depot.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  969 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyDepot\\Http\\Controllers\\PharmacyDepotController@show',
    'permission' => 'general-pharmacy-depot.pharmacy-depot.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  970 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyDepot\\Http\\Controllers\\PharmacyDepotController@store',
    'permission' => 'general-pharmacy-depot.pharmacy-depot.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  971 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyDepot\\Http\\Controllers\\PharmacyDepotController@update',
    'permission' => 'general-pharmacy-depot.pharmacy-depot.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  972 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyDepot\\Http\\Controllers\\PharmacyDepotController@destroy',
    'permission' => 'general-pharmacy-depot.pharmacy-depot.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  973 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyGuarantorMargin\\Http\\Controllers\\PharmacyGuarantorMarginController@index',
    'permission' => 'general-pharmacy-guarantor-margin.pharmacy-guarantor-margin.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  974 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyGuarantorMargin\\Http\\Controllers\\PharmacyGuarantorMarginController@show',
    'permission' => 'general-pharmacy-guarantor-margin.pharmacy-guarantor-margin.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  975 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyGuarantorMargin\\Http\\Controllers\\PharmacyGuarantorMarginController@store',
    'permission' => 'general-pharmacy-guarantor-margin.pharmacy-guarantor-margin.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  976 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyGuarantorMargin\\Http\\Controllers\\PharmacyGuarantorMarginController@update',
    'permission' => 'general-pharmacy-guarantor-margin.pharmacy-guarantor-margin.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  977 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyGuarantorMargin\\Http\\Controllers\\PharmacyGuarantorMarginController@destroy',
    'permission' => 'general-pharmacy-guarantor-margin.pharmacy-guarantor-margin.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  978 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyRoom\\Http\\Controllers\\GeneralPharmacyRoomController@index',
    'permission' => 'general-pharmacy-room.general-pharmacy-room.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  979 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyRoom\\Http\\Controllers\\GeneralPharmacyRoomController@show',
    'permission' => 'general-pharmacy-room.general-pharmacy-room.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  980 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyRoom\\Http\\Controllers\\GeneralPharmacyRoomController@store',
    'permission' => 'general-pharmacy-room.general-pharmacy-room.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  981 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyRoom\\Http\\Controllers\\GeneralPharmacyRoomController@update',
    'permission' => 'general-pharmacy-room.general-pharmacy-room.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  982 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyRoom\\Http\\Controllers\\GeneralPharmacyRoomController@destroy',
    'permission' => 'general-pharmacy-room.general-pharmacy-room.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  983 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyServiceRoom\\Http\\Controllers\\PharmacyServiceRoomController@index',
    'permission' => 'general-pharmacy-service-room.pharmacy-service-room.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  984 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyServiceRoom\\Http\\Controllers\\PharmacyServiceRoomController@show',
    'permission' => 'general-pharmacy-service-room.pharmacy-service-room.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  985 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyServiceRoom\\Http\\Controllers\\PharmacyServiceRoomController@store',
    'permission' => 'general-pharmacy-service-room.pharmacy-service-room.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  986 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyServiceRoom\\Http\\Controllers\\PharmacyServiceRoomController@update',
    'permission' => 'general-pharmacy-service-room.pharmacy-service-room.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  987 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyServiceRoom\\Http\\Controllers\\PharmacyServiceRoomController@destroy',
    'permission' => 'general-pharmacy-service-room.pharmacy-service-room.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  988 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyStatusType\\Http\\Controllers\\PharmacyStatusTypeController@index',
    'permission' => 'general-pharmacy-status-type.pharmacy-status-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  989 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyStatusType\\Http\\Controllers\\PharmacyStatusTypeController@show',
    'permission' => 'general-pharmacy-status-type.pharmacy-status-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  990 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyStatusType\\Http\\Controllers\\PharmacyStatusTypeController@store',
    'permission' => 'general-pharmacy-status-type.pharmacy-status-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  991 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyStatusType\\Http\\Controllers\\PharmacyStatusTypeController@update',
    'permission' => 'general-pharmacy-status-type.pharmacy-status-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  992 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyStatusType\\Http\\Controllers\\PharmacyStatusTypeController@destroy',
    'permission' => 'general-pharmacy-status-type.pharmacy-status-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  993 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyTariffByRoomClass\\Http\\Controllers\\PharmacyTariffByRoomClassController@index',
    'permission' => 'general-pharmacy-tariff-by-room-class.pharmacy-tariff-by-room-class.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  994 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyTariffByRoomClass\\Http\\Controllers\\PharmacyTariffByRoomClassController@show',
    'permission' => 'general-pharmacy-tariff-by-room-class.pharmacy-tariff-by-room-class.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  995 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyTariffByRoomClass\\Http\\Controllers\\PharmacyTariffByRoomClassController@store',
    'permission' => 'general-pharmacy-tariff-by-room-class.pharmacy-tariff-by-room-class.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  996 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyTariffByRoomClass\\Http\\Controllers\\PharmacyTariffByRoomClassController@update',
    'permission' => 'general-pharmacy-tariff-by-room-class.pharmacy-tariff-by-room-class.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  997 => 
  array (
    'controller_action' => 'Modules\\GeneralPharmacyTariffByRoomClass\\Http\\Controllers\\PharmacyTariffByRoomClassController@destroy',
    'permission' => 'general-pharmacy-tariff-by-room-class.pharmacy-tariff-by-room-class.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  998 => 
  array (
    'controller_action' => 'Modules\\GeneralPhysicianRestriction\\Http\\Controllers\\PhysicianRestrictionController@index',
    'permission' => 'general-physician-restriction.physician-restriction.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  999 => 
  array (
    'controller_action' => 'Modules\\GeneralPhysicianRestriction\\Http\\Controllers\\PhysicianRestrictionController@show',
    'permission' => 'general-physician-restriction.physician-restriction.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1000 => 
  array (
    'controller_action' => 'Modules\\GeneralPhysicianRestriction\\Http\\Controllers\\PhysicianRestrictionController@store',
    'permission' => 'general-physician-restriction.physician-restriction.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1001 => 
  array (
    'controller_action' => 'Modules\\GeneralPhysicianRestriction\\Http\\Controllers\\PhysicianRestrictionController@update',
    'permission' => 'general-physician-restriction.physician-restriction.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1002 => 
  array (
    'controller_action' => 'Modules\\GeneralPhysicianRestriction\\Http\\Controllers\\PhysicianRestrictionController@destroy',
    'permission' => 'general-physician-restriction.physician-restriction.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1003 => 
  array (
    'controller_action' => 'Modules\\GeneralPlanningPeriod\\Http\\Controllers\\PlanningPeriodController@index',
    'permission' => 'general-planning-period.planning-period.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1004 => 
  array (
    'controller_action' => 'Modules\\GeneralPlanningPeriod\\Http\\Controllers\\PlanningPeriodController@show',
    'permission' => 'general-planning-period.planning-period.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1005 => 
  array (
    'controller_action' => 'Modules\\GeneralPlanningPeriod\\Http\\Controllers\\PlanningPeriodController@store',
    'permission' => 'general-planning-period.planning-period.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1006 => 
  array (
    'controller_action' => 'Modules\\GeneralPlanningPeriod\\Http\\Controllers\\PlanningPeriodController@update',
    'permission' => 'general-planning-period.planning-period.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1007 => 
  array (
    'controller_action' => 'Modules\\GeneralPlanningPeriod\\Http\\Controllers\\PlanningPeriodController@destroy',
    'permission' => 'general-planning-period.planning-period.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1008 => 
  array (
    'controller_action' => 'Modules\\GeneralPositionTitle\\Http\\Controllers\\PositionTitleController@index',
    'permission' => 'general-position-title.position-title.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1009 => 
  array (
    'controller_action' => 'Modules\\GeneralPositionTitle\\Http\\Controllers\\PositionTitleController@show',
    'permission' => 'general-position-title.position-title.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1010 => 
  array (
    'controller_action' => 'Modules\\GeneralPositionTitle\\Http\\Controllers\\PositionTitleController@store',
    'permission' => 'general-position-title.position-title.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1011 => 
  array (
    'controller_action' => 'Modules\\GeneralPositionTitle\\Http\\Controllers\\PositionTitleController@update',
    'permission' => 'general-position-title.position-title.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1012 => 
  array (
    'controller_action' => 'Modules\\GeneralPositionTitle\\Http\\Controllers\\PositionTitleController@destroy',
    'permission' => 'general-position-title.position-title.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1013 => 
  array (
    'controller_action' => 'Modules\\GeneralPpk\\Http\\Controllers\\PpkController@index',
    'permission' => 'general-ppk.ppk.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1014 => 
  array (
    'controller_action' => 'Modules\\GeneralPpk\\Http\\Controllers\\PpkController@show',
    'permission' => 'general-ppk.ppk.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1015 => 
  array (
    'controller_action' => 'Modules\\GeneralPpk\\Http\\Controllers\\PpkController@store',
    'permission' => 'general-ppk.ppk.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1016 => 
  array (
    'controller_action' => 'Modules\\GeneralPpk\\Http\\Controllers\\PpkController@update',
    'permission' => 'general-ppk.ppk.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1017 => 
  array (
    'controller_action' => 'Modules\\GeneralPpk\\Http\\Controllers\\PpkController@destroy',
    'permission' => 'general-ppk.ppk.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1018 => 
  array (
    'controller_action' => 'Modules\\GeneralPrescriptionFrequencyRule\\Http\\Controllers\\PrescriptionFrequencyRuleController@index',
    'permission' => 'general-prescription-frequency-rule.prescription-frequency-rule.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1019 => 
  array (
    'controller_action' => 'Modules\\GeneralPrescriptionFrequencyRule\\Http\\Controllers\\PrescriptionFrequencyRuleController@show',
    'permission' => 'general-prescription-frequency-rule.prescription-frequency-rule.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1020 => 
  array (
    'controller_action' => 'Modules\\GeneralPrescriptionFrequencyRule\\Http\\Controllers\\PrescriptionFrequencyRuleController@store',
    'permission' => 'general-prescription-frequency-rule.prescription-frequency-rule.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1021 => 
  array (
    'controller_action' => 'Modules\\GeneralPrescriptionFrequencyRule\\Http\\Controllers\\PrescriptionFrequencyRuleController@update',
    'permission' => 'general-prescription-frequency-rule.prescription-frequency-rule.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1022 => 
  array (
    'controller_action' => 'Modules\\GeneralPrescriptionFrequencyRule\\Http\\Controllers\\PrescriptionFrequencyRuleController@destroy',
    'permission' => 'general-prescription-frequency-rule.prescription-frequency-rule.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1023 => 
  array (
    'controller_action' => 'Modules\\GeneralPrescriptionFrequencyRuleCategory\\Http\\Controllers\\PrescriptionFrequencyRuleCategoryController@index',
    'permission' => 'general-prescription-frequency-rule-category.prescription-frequency-rule-category.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1024 => 
  array (
    'controller_action' => 'Modules\\GeneralPrescriptionFrequencyRuleCategory\\Http\\Controllers\\PrescriptionFrequencyRuleCategoryController@show',
    'permission' => 'general-prescription-frequency-rule-category.prescription-frequency-rule-category.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1025 => 
  array (
    'controller_action' => 'Modules\\GeneralPrescriptionFrequencyRuleCategory\\Http\\Controllers\\PrescriptionFrequencyRuleCategoryController@store',
    'permission' => 'general-prescription-frequency-rule-category.prescription-frequency-rule-category.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1026 => 
  array (
    'controller_action' => 'Modules\\GeneralPrescriptionFrequencyRuleCategory\\Http\\Controllers\\PrescriptionFrequencyRuleCategoryController@update',
    'permission' => 'general-prescription-frequency-rule-category.prescription-frequency-rule-category.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1027 => 
  array (
    'controller_action' => 'Modules\\GeneralPrescriptionFrequencyRuleCategory\\Http\\Controllers\\PrescriptionFrequencyRuleCategoryController@destroy',
    'permission' => 'general-prescription-frequency-rule-category.prescription-frequency-rule-category.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1028 => 
  array (
    'controller_action' => 'Modules\\GeneralPrescriptionOriginUnitRestriction\\Http\\Controllers\\PrescriptionOriginUnitRestrictionController@index',
    'permission' => 'general-prescription-origin-unit-restriction.prescription-origin-unit-restriction.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1029 => 
  array (
    'controller_action' => 'Modules\\GeneralPrescriptionOriginUnitRestriction\\Http\\Controllers\\PrescriptionOriginUnitRestrictionController@show',
    'permission' => 'general-prescription-origin-unit-restriction.prescription-origin-unit-restriction.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1030 => 
  array (
    'controller_action' => 'Modules\\GeneralPrescriptionOriginUnitRestriction\\Http\\Controllers\\PrescriptionOriginUnitRestrictionController@store',
    'permission' => 'general-prescription-origin-unit-restriction.prescription-origin-unit-restriction.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1031 => 
  array (
    'controller_action' => 'Modules\\GeneralPrescriptionOriginUnitRestriction\\Http\\Controllers\\PrescriptionOriginUnitRestrictionController@update',
    'permission' => 'general-prescription-origin-unit-restriction.prescription-origin-unit-restriction.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1032 => 
  array (
    'controller_action' => 'Modules\\GeneralPrescriptionOriginUnitRestriction\\Http\\Controllers\\PrescriptionOriginUnitRestrictionController@destroy',
    'permission' => 'general-prescription-origin-unit-restriction.prescription-origin-unit-restriction.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1033 => 
  array (
    'controller_action' => 'Modules\\GeneralPrescriptionType\\Http\\Controllers\\PrescriptionTypeController@index',
    'permission' => 'general-prescription-type.prescription-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1034 => 
  array (
    'controller_action' => 'Modules\\GeneralPrescriptionType\\Http\\Controllers\\PrescriptionTypeController@show',
    'permission' => 'general-prescription-type.prescription-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1035 => 
  array (
    'controller_action' => 'Modules\\GeneralPrescriptionType\\Http\\Controllers\\PrescriptionTypeController@store',
    'permission' => 'general-prescription-type.prescription-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1036 => 
  array (
    'controller_action' => 'Modules\\GeneralPrescriptionType\\Http\\Controllers\\PrescriptionTypeController@update',
    'permission' => 'general-prescription-type.prescription-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1037 => 
  array (
    'controller_action' => 'Modules\\GeneralPrescriptionType\\Http\\Controllers\\PrescriptionTypeController@destroy',
    'permission' => 'general-prescription-type.prescription-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1038 => 
  array (
    'controller_action' => 'Modules\\GeneralPrintType\\Http\\Controllers\\PrintTypeController@index',
    'permission' => 'general-print-type.print-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1039 => 
  array (
    'controller_action' => 'Modules\\GeneralPrintType\\Http\\Controllers\\PrintTypeController@show',
    'permission' => 'general-print-type.print-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1040 => 
  array (
    'controller_action' => 'Modules\\GeneralPrintType\\Http\\Controllers\\PrintTypeController@store',
    'permission' => 'general-print-type.print-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1041 => 
  array (
    'controller_action' => 'Modules\\GeneralPrintType\\Http\\Controllers\\PrintTypeController@update',
    'permission' => 'general-print-type.print-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1042 => 
  array (
    'controller_action' => 'Modules\\GeneralPrintType\\Http\\Controllers\\PrintTypeController@destroy',
    'permission' => 'general-print-type.print-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1043 => 
  array (
    'controller_action' => 'Modules\\GeneralProcedure\\Http\\Controllers\\ProcedureController@index',
    'permission' => 'general-procedure.procedure.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1044 => 
  array (
    'controller_action' => 'Modules\\GeneralProcedure\\Http\\Controllers\\ProcedureController@show',
    'permission' => 'general-procedure.procedure.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1045 => 
  array (
    'controller_action' => 'Modules\\GeneralProcedure\\Http\\Controllers\\ProcedureController@store',
    'permission' => 'general-procedure.procedure.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1046 => 
  array (
    'controller_action' => 'Modules\\GeneralProcedure\\Http\\Controllers\\ProcedureController@update',
    'permission' => 'general-procedure.procedure.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1047 => 
  array (
    'controller_action' => 'Modules\\GeneralProcedure\\Http\\Controllers\\ProcedureController@destroy',
    'permission' => 'general-procedure.procedure.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1048 => 
  array (
    'controller_action' => 'Modules\\GeneralProfession\\Http\\Controllers\\ProfessionController@index',
    'permission' => 'general-profession.profession.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1049 => 
  array (
    'controller_action' => 'Modules\\GeneralProfession\\Http\\Controllers\\ProfessionController@show',
    'permission' => 'general-profession.profession.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1050 => 
  array (
    'controller_action' => 'Modules\\GeneralProfession\\Http\\Controllers\\ProfessionController@store',
    'permission' => 'general-profession.profession.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1051 => 
  array (
    'controller_action' => 'Modules\\GeneralProfession\\Http\\Controllers\\ProfessionController@update',
    'permission' => 'general-profession.profession.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1052 => 
  array (
    'controller_action' => 'Modules\\GeneralProfession\\Http\\Controllers\\ProfessionController@destroy',
    'permission' => 'general-profession.profession.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1053 => 
  array (
    'controller_action' => 'Modules\\GeneralQuantityRestriction\\Http\\Controllers\\QuantityRestrictionController@index',
    'permission' => 'general-quantity-restriction.quantity-restriction.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1054 => 
  array (
    'controller_action' => 'Modules\\GeneralQuantityRestriction\\Http\\Controllers\\QuantityRestrictionController@show',
    'permission' => 'general-quantity-restriction.quantity-restriction.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1055 => 
  array (
    'controller_action' => 'Modules\\GeneralQuantityRestriction\\Http\\Controllers\\QuantityRestrictionController@store',
    'permission' => 'general-quantity-restriction.quantity-restriction.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1056 => 
  array (
    'controller_action' => 'Modules\\GeneralQuantityRestriction\\Http\\Controllers\\QuantityRestrictionController@update',
    'permission' => 'general-quantity-restriction.quantity-restriction.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1057 => 
  array (
    'controller_action' => 'Modules\\GeneralQuantityRestriction\\Http\\Controllers\\QuantityRestrictionController@destroy',
    'permission' => 'general-quantity-restriction.quantity-restriction.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1058 => 
  array (
    'controller_action' => 'Modules\\GeneralQuarter\\Http\\Controllers\\QuarterController@index',
    'permission' => 'general-quarter.quarter.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1059 => 
  array (
    'controller_action' => 'Modules\\GeneralQuarter\\Http\\Controllers\\QuarterController@show',
    'permission' => 'general-quarter.quarter.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1060 => 
  array (
    'controller_action' => 'Modules\\GeneralQuarter\\Http\\Controllers\\QuarterController@store',
    'permission' => 'general-quarter.quarter.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1061 => 
  array (
    'controller_action' => 'Modules\\GeneralQuarter\\Http\\Controllers\\QuarterController@update',
    'permission' => 'general-quarter.quarter.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1062 => 
  array (
    'controller_action' => 'Modules\\GeneralQuarter\\Http\\Controllers\\QuarterController@destroy',
    'permission' => 'general-quarter.quarter.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1063 => 
  array (
    'controller_action' => 'Modules\\GeneralRadiologyRoom\\Http\\Controllers\\GeneralRadiologyRoomController@index',
    'permission' => 'general-radiology-room.general-radiology-room.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1064 => 
  array (
    'controller_action' => 'Modules\\GeneralRadiologyRoom\\Http\\Controllers\\GeneralRadiologyRoomController@show',
    'permission' => 'general-radiology-room.general-radiology-room.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1065 => 
  array (
    'controller_action' => 'Modules\\GeneralRadiologyRoom\\Http\\Controllers\\GeneralRadiologyRoomController@store',
    'permission' => 'general-radiology-room.general-radiology-room.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1066 => 
  array (
    'controller_action' => 'Modules\\GeneralRadiologyRoom\\Http\\Controllers\\GeneralRadiologyRoomController@update',
    'permission' => 'general-radiology-room.general-radiology-room.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1067 => 
  array (
    'controller_action' => 'Modules\\GeneralRadiologyRoom\\Http\\Controllers\\GeneralRadiologyRoomController@destroy',
    'permission' => 'general-radiology-room.general-radiology-room.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1068 => 
  array (
    'controller_action' => 'Modules\\GeneralReferralCode\\Http\\Controllers\\ReferralCodeController@index',
    'permission' => 'general-referral-code.referral-code.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1069 => 
  array (
    'controller_action' => 'Modules\\GeneralReferralCode\\Http\\Controllers\\ReferralCodeController@show',
    'permission' => 'general-referral-code.referral-code.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1070 => 
  array (
    'controller_action' => 'Modules\\GeneralReferralCode\\Http\\Controllers\\ReferralCodeController@store',
    'permission' => 'general-referral-code.referral-code.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1071 => 
  array (
    'controller_action' => 'Modules\\GeneralReferralCode\\Http\\Controllers\\ReferralCodeController@update',
    'permission' => 'general-referral-code.referral-code.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1072 => 
  array (
    'controller_action' => 'Modules\\GeneralReferralCode\\Http\\Controllers\\ReferralCodeController@destroy',
    'permission' => 'general-referral-code.referral-code.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1073 => 
  array (
    'controller_action' => 'Modules\\GeneralReferralRoom\\Http\\Controllers\\ReferralRoomController@index',
    'permission' => 'general-referral-room.referral-room.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1074 => 
  array (
    'controller_action' => 'Modules\\GeneralReferralRoom\\Http\\Controllers\\ReferralRoomController@show',
    'permission' => 'general-referral-room.referral-room.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1075 => 
  array (
    'controller_action' => 'Modules\\GeneralReferralRoom\\Http\\Controllers\\ReferralRoomController@store',
    'permission' => 'general-referral-room.referral-room.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1076 => 
  array (
    'controller_action' => 'Modules\\GeneralReferralRoom\\Http\\Controllers\\ReferralRoomController@update',
    'permission' => 'general-referral-room.referral-room.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1077 => 
  array (
    'controller_action' => 'Modules\\GeneralReferralRoom\\Http\\Controllers\\ReferralRoomController@destroy',
    'permission' => 'general-referral-room.referral-room.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1078 => 
  array (
    'controller_action' => 'Modules\\GeneralReferralStatus\\Http\\Controllers\\ReferralStatusController@index',
    'permission' => 'general-referral-status.referral-status.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1079 => 
  array (
    'controller_action' => 'Modules\\GeneralReferralStatus\\Http\\Controllers\\ReferralStatusController@show',
    'permission' => 'general-referral-status.referral-status.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1080 => 
  array (
    'controller_action' => 'Modules\\GeneralReferralStatus\\Http\\Controllers\\ReferralStatusController@store',
    'permission' => 'general-referral-status.referral-status.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1081 => 
  array (
    'controller_action' => 'Modules\\GeneralReferralStatus\\Http\\Controllers\\ReferralStatusController@update',
    'permission' => 'general-referral-status.referral-status.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1082 => 
  array (
    'controller_action' => 'Modules\\GeneralReferralStatus\\Http\\Controllers\\ReferralStatusController@destroy',
    'permission' => 'general-referral-status.referral-status.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1083 => 
  array (
    'controller_action' => 'Modules\\GeneralReferralType\\Http\\Controllers\\ReferralTypeController@index',
    'permission' => 'general-referral-type.referral-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1084 => 
  array (
    'controller_action' => 'Modules\\GeneralReferralType\\Http\\Controllers\\ReferralTypeController@show',
    'permission' => 'general-referral-type.referral-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1085 => 
  array (
    'controller_action' => 'Modules\\GeneralReferralType\\Http\\Controllers\\ReferralTypeController@store',
    'permission' => 'general-referral-type.referral-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1086 => 
  array (
    'controller_action' => 'Modules\\GeneralReferralType\\Http\\Controllers\\ReferralTypeController@update',
    'permission' => 'general-referral-type.referral-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1087 => 
  array (
    'controller_action' => 'Modules\\GeneralReferralType\\Http\\Controllers\\ReferralTypeController@destroy',
    'permission' => 'general-referral-type.referral-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1088 => 
  array (
    'controller_action' => 'Modules\\GeneralRegion\\Http\\Controllers\\RegionController@provinces',
    'permission' => 'general-region.region.provinces',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1089 => 
  array (
    'controller_action' => 'Modules\\GeneralRegion\\Http\\Controllers\\RegionController@cities',
    'permission' => 'general-region.region.cities',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1090 => 
  array (
    'controller_action' => 'Modules\\GeneralRegion\\Http\\Controllers\\RegionController@districts',
    'permission' => 'general-region.region.districts',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1091 => 
  array (
    'controller_action' => 'Modules\\GeneralRegion\\Http\\Controllers\\RegionController@villages',
    'permission' => 'general-region.region.villages',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1092 => 
  array (
    'controller_action' => 'Modules\\GeneralRegionType\\Http\\Controllers\\RegionTypeController@index',
    'permission' => 'general-region-type.region-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1093 => 
  array (
    'controller_action' => 'Modules\\GeneralRegionType\\Http\\Controllers\\RegionTypeController@show',
    'permission' => 'general-region-type.region-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1094 => 
  array (
    'controller_action' => 'Modules\\GeneralRegionType\\Http\\Controllers\\RegionTypeController@store',
    'permission' => 'general-region-type.region-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1095 => 
  array (
    'controller_action' => 'Modules\\GeneralRegionType\\Http\\Controllers\\RegionTypeController@update',
    'permission' => 'general-region-type.region-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1096 => 
  array (
    'controller_action' => 'Modules\\GeneralRegionType\\Http\\Controllers\\RegionTypeController@destroy',
    'permission' => 'general-region-type.region-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1097 => 
  array (
    'controller_action' => 'Modules\\GeneralReligion\\Http\\Controllers\\ReligionController@index',
    'permission' => 'general-religion.religion.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1098 => 
  array (
    'controller_action' => 'Modules\\GeneralReligion\\Http\\Controllers\\ReligionController@show',
    'permission' => 'general-religion.religion.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1099 => 
  array (
    'controller_action' => 'Modules\\GeneralReligion\\Http\\Controllers\\ReligionController@store',
    'permission' => 'general-religion.religion.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1100 => 
  array (
    'controller_action' => 'Modules\\GeneralReligion\\Http\\Controllers\\ReligionController@update',
    'permission' => 'general-religion.religion.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1101 => 
  array (
    'controller_action' => 'Modules\\GeneralReligion\\Http\\Controllers\\ReligionController@destroy',
    'permission' => 'general-religion.religion.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1102 => 
  array (
    'controller_action' => 'Modules\\GeneralReportType\\Http\\Controllers\\ReportTypeController@index',
    'permission' => 'general-report-type.report-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1103 => 
  array (
    'controller_action' => 'Modules\\GeneralReportType\\Http\\Controllers\\ReportTypeController@show',
    'permission' => 'general-report-type.report-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1104 => 
  array (
    'controller_action' => 'Modules\\GeneralReportType\\Http\\Controllers\\ReportTypeController@store',
    'permission' => 'general-report-type.report-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1105 => 
  array (
    'controller_action' => 'Modules\\GeneralReportType\\Http\\Controllers\\ReportTypeController@update',
    'permission' => 'general-report-type.report-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1106 => 
  array (
    'controller_action' => 'Modules\\GeneralReportType\\Http\\Controllers\\ReportTypeController@destroy',
    'permission' => 'general-report-type.report-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1107 => 
  array (
    'controller_action' => 'Modules\\GeneralReportTypeItem\\Http\\Controllers\\ReportTypeItemController@index',
    'permission' => 'general-report-type-item.report-type-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1108 => 
  array (
    'controller_action' => 'Modules\\GeneralReportTypeItem\\Http\\Controllers\\ReportTypeItemController@show',
    'permission' => 'general-report-type-item.report-type-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1109 => 
  array (
    'controller_action' => 'Modules\\GeneralReportTypeItem\\Http\\Controllers\\ReportTypeItemController@store',
    'permission' => 'general-report-type-item.report-type-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1110 => 
  array (
    'controller_action' => 'Modules\\GeneralReportTypeItem\\Http\\Controllers\\ReportTypeItemController@update',
    'permission' => 'general-report-type-item.report-type-item.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1111 => 
  array (
    'controller_action' => 'Modules\\GeneralReportTypeItem\\Http\\Controllers\\ReportTypeItemController@destroy',
    'permission' => 'general-report-type-item.report-type-item.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1112 => 
  array (
    'controller_action' => 'Modules\\GeneralReservationStatus\\Http\\Controllers\\ReservationStatusController@index',
    'permission' => 'general-reservation-status.reservation-status.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1113 => 
  array (
    'controller_action' => 'Modules\\GeneralReservationStatus\\Http\\Controllers\\ReservationStatusController@show',
    'permission' => 'general-reservation-status.reservation-status.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1114 => 
  array (
    'controller_action' => 'Modules\\GeneralReservationStatus\\Http\\Controllers\\ReservationStatusController@store',
    'permission' => 'general-reservation-status.reservation-status.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1115 => 
  array (
    'controller_action' => 'Modules\\GeneralReservationStatus\\Http\\Controllers\\ReservationStatusController@update',
    'permission' => 'general-reservation-status.reservation-status.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1116 => 
  array (
    'controller_action' => 'Modules\\GeneralReservationStatus\\Http\\Controllers\\ReservationStatusController@destroy',
    'permission' => 'general-reservation-status.reservation-status.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1117 => 
  array (
    'controller_action' => 'Modules\\GeneralReturnCancellationReason\\Http\\Controllers\\ReturnCancellationReasonController@index',
    'permission' => 'general-return-cancellation-reason.return-cancellation-reason.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1118 => 
  array (
    'controller_action' => 'Modules\\GeneralReturnCancellationReason\\Http\\Controllers\\ReturnCancellationReasonController@show',
    'permission' => 'general-return-cancellation-reason.return-cancellation-reason.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1119 => 
  array (
    'controller_action' => 'Modules\\GeneralReturnCancellationReason\\Http\\Controllers\\ReturnCancellationReasonController@store',
    'permission' => 'general-return-cancellation-reason.return-cancellation-reason.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1120 => 
  array (
    'controller_action' => 'Modules\\GeneralReturnCancellationReason\\Http\\Controllers\\ReturnCancellationReasonController@update',
    'permission' => 'general-return-cancellation-reason.return-cancellation-reason.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1121 => 
  array (
    'controller_action' => 'Modules\\GeneralReturnCancellationReason\\Http\\Controllers\\ReturnCancellationReasonController@destroy',
    'permission' => 'general-return-cancellation-reason.return-cancellation-reason.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1122 => 
  array (
    'controller_action' => 'Modules\\GeneralReturnCancellationType\\Http\\Controllers\\ReturnCancellationTypeController@index',
    'permission' => 'general-return-cancellation-type.return-cancellation-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1123 => 
  array (
    'controller_action' => 'Modules\\GeneralReturnCancellationType\\Http\\Controllers\\ReturnCancellationTypeController@show',
    'permission' => 'general-return-cancellation-type.return-cancellation-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1124 => 
  array (
    'controller_action' => 'Modules\\GeneralReturnCancellationType\\Http\\Controllers\\ReturnCancellationTypeController@store',
    'permission' => 'general-return-cancellation-type.return-cancellation-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1125 => 
  array (
    'controller_action' => 'Modules\\GeneralReturnCancellationType\\Http\\Controllers\\ReturnCancellationTypeController@update',
    'permission' => 'general-return-cancellation-type.return-cancellation-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1126 => 
  array (
    'controller_action' => 'Modules\\GeneralReturnCancellationType\\Http\\Controllers\\ReturnCancellationTypeController@destroy',
    'permission' => 'general-return-cancellation-type.return-cancellation-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1127 => 
  array (
    'controller_action' => 'Modules\\GeneralRoom\\Http\\Controllers\\RoomController@index',
    'permission' => 'general-room.room.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1128 => 
  array (
    'controller_action' => 'Modules\\GeneralRoom\\Http\\Controllers\\RoomController@store',
    'permission' => 'general-room.room.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1129 => 
  array (
    'controller_action' => 'Modules\\GeneralRoom\\Http\\Controllers\\RoomController@show',
    'permission' => 'general-room.room.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1130 => 
  array (
    'controller_action' => 'Modules\\GeneralRoom\\Http\\Controllers\\RoomController@update',
    'permission' => 'general-room.room.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1131 => 
  array (
    'controller_action' => 'Modules\\GeneralRoom\\Http\\Controllers\\RoomController@destroy',
    'permission' => 'general-room.room.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1132 => 
  array (
    'controller_action' => 'Modules\\GeneralRoomClass\\Http\\Controllers\\RoomClassController@index',
    'permission' => 'general-room-class.room-class.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1133 => 
  array (
    'controller_action' => 'Modules\\GeneralRoomClass\\Http\\Controllers\\RoomClassController@show',
    'permission' => 'general-room-class.room-class.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1134 => 
  array (
    'controller_action' => 'Modules\\GeneralRoomClass\\Http\\Controllers\\RoomClassController@store',
    'permission' => 'general-room-class.room-class.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1135 => 
  array (
    'controller_action' => 'Modules\\GeneralRoomClass\\Http\\Controllers\\RoomClassController@update',
    'permission' => 'general-room-class.room-class.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1136 => 
  array (
    'controller_action' => 'Modules\\GeneralRoomClass\\Http\\Controllers\\RoomClassController@destroy',
    'permission' => 'general-room-class.room-class.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1137 => 
  array (
    'controller_action' => 'Modules\\GeneralRoomClassReferenceGroup\\Http\\Controllers\\RoomClassReferenceGroupController@index',
    'permission' => 'general-room-class-reference-group.room-class-reference-group.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1138 => 
  array (
    'controller_action' => 'Modules\\GeneralRoomClassReferenceGroup\\Http\\Controllers\\RoomClassReferenceGroupController@show',
    'permission' => 'general-room-class-reference-group.room-class-reference-group.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1139 => 
  array (
    'controller_action' => 'Modules\\GeneralRoomClassReferenceGroup\\Http\\Controllers\\RoomClassReferenceGroupController@store',
    'permission' => 'general-room-class-reference-group.room-class-reference-group.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1140 => 
  array (
    'controller_action' => 'Modules\\GeneralRoomClassReferenceGroup\\Http\\Controllers\\RoomClassReferenceGroupController@update',
    'permission' => 'general-room-class-reference-group.room-class-reference-group.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1141 => 
  array (
    'controller_action' => 'Modules\\GeneralRoomClassReferenceGroup\\Http\\Controllers\\RoomClassReferenceGroupController@destroy',
    'permission' => 'general-room-class-reference-group.room-class-reference-group.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1142 => 
  array (
    'controller_action' => 'Modules\\GeneralSalesTax\\Http\\Controllers\\SalesTaxController@index',
    'permission' => 'general-sales-tax.sales-tax.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1143 => 
  array (
    'controller_action' => 'Modules\\GeneralSalesTax\\Http\\Controllers\\SalesTaxController@show',
    'permission' => 'general-sales-tax.sales-tax.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1144 => 
  array (
    'controller_action' => 'Modules\\GeneralSalesTax\\Http\\Controllers\\SalesTaxController@store',
    'permission' => 'general-sales-tax.sales-tax.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1145 => 
  array (
    'controller_action' => 'Modules\\GeneralSalesTax\\Http\\Controllers\\SalesTaxController@update',
    'permission' => 'general-sales-tax.sales-tax.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1146 => 
  array (
    'controller_action' => 'Modules\\GeneralSalesTax\\Http\\Controllers\\SalesTaxController@destroy',
    'permission' => 'general-sales-tax.sales-tax.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1147 => 
  array (
    'controller_action' => 'Modules\\GeneralScannedDocument\\Http\\Controllers\\GeneralScannedDocumentController@index',
    'permission' => 'general-scanned-document.general-scanned-document.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1148 => 
  array (
    'controller_action' => 'Modules\\GeneralScannedDocument\\Http\\Controllers\\GeneralScannedDocumentController@show',
    'permission' => 'general-scanned-document.general-scanned-document.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1149 => 
  array (
    'controller_action' => 'Modules\\GeneralScannedDocument\\Http\\Controllers\\GeneralScannedDocumentController@store',
    'permission' => 'general-scanned-document.general-scanned-document.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1150 => 
  array (
    'controller_action' => 'Modules\\GeneralService\\Http\\Controllers\\ServiceController@index',
    'permission' => 'general-service.service.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1151 => 
  array (
    'controller_action' => 'Modules\\GeneralService\\Http\\Controllers\\ServiceController@show',
    'permission' => 'general-service.service.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1152 => 
  array (
    'controller_action' => 'Modules\\GeneralService\\Http\\Controllers\\ServiceController@store',
    'permission' => 'general-service.service.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1153 => 
  array (
    'controller_action' => 'Modules\\GeneralService\\Http\\Controllers\\ServiceController@update',
    'permission' => 'general-service.service.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1154 => 
  array (
    'controller_action' => 'Modules\\GeneralService\\Http\\Controllers\\ServiceController@destroy',
    'permission' => 'general-service.service.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1155 => 
  array (
    'controller_action' => 'Modules\\GeneralServiceTariff\\Http\\Controllers\\ServiceTariffController@index',
    'permission' => 'general-service-tariff.service-tariff.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1156 => 
  array (
    'controller_action' => 'Modules\\GeneralServiceTariff\\Http\\Controllers\\ServiceTariffController@show',
    'permission' => 'general-service-tariff.service-tariff.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1157 => 
  array (
    'controller_action' => 'Modules\\GeneralServiceTariff\\Http\\Controllers\\ServiceTariffController@store',
    'permission' => 'general-service-tariff.service-tariff.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1158 => 
  array (
    'controller_action' => 'Modules\\GeneralServiceTariff\\Http\\Controllers\\ServiceTariffController@update',
    'permission' => 'general-service-tariff.service-tariff.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1159 => 
  array (
    'controller_action' => 'Modules\\GeneralServiceTariff\\Http\\Controllers\\ServiceTariffController@destroy',
    'permission' => 'general-service-tariff.service-tariff.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1160 => 
  array (
    'controller_action' => 'Modules\\GeneralServiceTariffDistribution\\Http\\Controllers\\ServiceTariffDistributionController@index',
    'permission' => 'general-service-tariff-distribution.service-tariff-distribution.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1161 => 
  array (
    'controller_action' => 'Modules\\GeneralServiceTariffDistribution\\Http\\Controllers\\ServiceTariffDistributionController@show',
    'permission' => 'general-service-tariff-distribution.service-tariff-distribution.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1162 => 
  array (
    'controller_action' => 'Modules\\GeneralServiceTariffDistribution\\Http\\Controllers\\ServiceTariffDistributionController@store',
    'permission' => 'general-service-tariff-distribution.service-tariff-distribution.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1163 => 
  array (
    'controller_action' => 'Modules\\GeneralServiceTariffDistribution\\Http\\Controllers\\ServiceTariffDistributionController@update',
    'permission' => 'general-service-tariff-distribution.service-tariff-distribution.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1164 => 
  array (
    'controller_action' => 'Modules\\GeneralServiceTariffDistribution\\Http\\Controllers\\ServiceTariffDistributionController@destroy',
    'permission' => 'general-service-tariff-distribution.service-tariff-distribution.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1165 => 
  array (
    'controller_action' => 'Modules\\GeneralServiceType\\Http\\Controllers\\ServiceTypeController@index',
    'permission' => 'general-service-type.service-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1166 => 
  array (
    'controller_action' => 'Modules\\GeneralServiceType\\Http\\Controllers\\ServiceTypeController@show',
    'permission' => 'general-service-type.service-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1167 => 
  array (
    'controller_action' => 'Modules\\GeneralServiceType\\Http\\Controllers\\ServiceTypeController@store',
    'permission' => 'general-service-type.service-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1168 => 
  array (
    'controller_action' => 'Modules\\GeneralServiceType\\Http\\Controllers\\ServiceTypeController@update',
    'permission' => 'general-service-type.service-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1169 => 
  array (
    'controller_action' => 'Modules\\GeneralServiceType\\Http\\Controllers\\ServiceTypeController@destroy',
    'permission' => 'general-service-type.service-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1170 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbAnatomyClassification\\Http\\Controllers\\SitbAnatomyClassificationController@index',
    'permission' => 'general-sitb-anatomy-classification.sitb-anatomy-classification.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1171 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbAnatomyClassification\\Http\\Controllers\\SitbAnatomyClassificationController@show',
    'permission' => 'general-sitb-anatomy-classification.sitb-anatomy-classification.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1172 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbAnatomyClassification\\Http\\Controllers\\SitbAnatomyClassificationController@store',
    'permission' => 'general-sitb-anatomy-classification.sitb-anatomy-classification.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1173 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbAnatomyClassification\\Http\\Controllers\\SitbAnatomyClassificationController@update',
    'permission' => 'general-sitb-anatomy-classification.sitb-anatomy-classification.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1174 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbAnatomyClassification\\Http\\Controllers\\SitbAnatomyClassificationController@destroy',
    'permission' => 'general-sitb-anatomy-classification.sitb-anatomy-classification.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1175 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbArt\\Http\\Controllers\\SitbArtController@index',
    'permission' => 'general-sitb-art.sitb-art.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1176 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbArt\\Http\\Controllers\\SitbArtController@show',
    'permission' => 'general-sitb-art.sitb-art.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1177 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbArt\\Http\\Controllers\\SitbArtController@store',
    'permission' => 'general-sitb-art.sitb-art.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1178 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbArt\\Http\\Controllers\\SitbArtController@update',
    'permission' => 'general-sitb-art.sitb-art.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1179 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbArt\\Http\\Controllers\\SitbArtController@destroy',
    'permission' => 'general-sitb-art.sitb-art.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1180 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbChestXrayResult\\Http\\Controllers\\SitbChestXrayResultController@index',
    'permission' => 'general-sitb-chest-xray-result.sitb-chest-xray-result.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1181 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbChestXrayResult\\Http\\Controllers\\SitbChestXrayResultController@show',
    'permission' => 'general-sitb-chest-xray-result.sitb-chest-xray-result.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1182 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbChestXrayResult\\Http\\Controllers\\SitbChestXrayResultController@store',
    'permission' => 'general-sitb-chest-xray-result.sitb-chest-xray-result.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1183 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbChestXrayResult\\Http\\Controllers\\SitbChestXrayResultController@update',
    'permission' => 'general-sitb-chest-xray-result.sitb-chest-xray-result.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1184 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbChestXrayResult\\Http\\Controllers\\SitbChestXrayResultController@destroy',
    'permission' => 'general-sitb-chest-xray-result.sitb-chest-xray-result.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1185 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbChildTbScore0To13\\Http\\Controllers\\SitbChildTbScore0To13Controller@index',
    'permission' => 'general-sitb-child-tb-score0-to13.sitb-child-tb-score0-to13.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1186 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbChildTbScore0To13\\Http\\Controllers\\SitbChildTbScore0To13Controller@show',
    'permission' => 'general-sitb-child-tb-score0-to13.sitb-child-tb-score0-to13.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1187 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbChildTbScore0To13\\Http\\Controllers\\SitbChildTbScore0To13Controller@store',
    'permission' => 'general-sitb-child-tb-score0-to13.sitb-child-tb-score0-to13.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1188 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbChildTbScore0To13\\Http\\Controllers\\SitbChildTbScore0To13Controller@update',
    'permission' => 'general-sitb-child-tb-score0-to13.sitb-child-tb-score0-to13.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1189 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbChildTbScore0To13\\Http\\Controllers\\SitbChildTbScore0To13Controller@destroy',
    'permission' => 'general-sitb-child-tb-score0-to13.sitb-child-tb-score0-to13.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1190 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbChildTbScore5\\Http\\Controllers\\SitbChildTbScore5Controller@index',
    'permission' => 'general-sitb-child-tb-score5.sitb-child-tb-score5.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1191 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbChildTbScore5\\Http\\Controllers\\SitbChildTbScore5Controller@show',
    'permission' => 'general-sitb-child-tb-score5.sitb-child-tb-score5.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1192 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbChildTbScore5\\Http\\Controllers\\SitbChildTbScore5Controller@store',
    'permission' => 'general-sitb-child-tb-score5.sitb-child-tb-score5.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1193 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbChildTbScore5\\Http\\Controllers\\SitbChildTbScore5Controller@update',
    'permission' => 'general-sitb-child-tb-score5.sitb-child-tb-score5.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1194 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbChildTbScore5\\Http\\Controllers\\SitbChildTbScore5Controller@destroy',
    'permission' => 'general-sitb-child-tb-score5.sitb-child-tb-score5.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1195 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbChildTbScore6\\Http\\Controllers\\SitbChildTbScore6Controller@index',
    'permission' => 'general-sitb-child-tb-score6.sitb-child-tb-score6.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1196 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbChildTbScore6\\Http\\Controllers\\SitbChildTbScore6Controller@show',
    'permission' => 'general-sitb-child-tb-score6.sitb-child-tb-score6.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1197 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbChildTbScore6\\Http\\Controllers\\SitbChildTbScore6Controller@store',
    'permission' => 'general-sitb-child-tb-score6.sitb-child-tb-score6.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1198 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbChildTbScore6\\Http\\Controllers\\SitbChildTbScore6Controller@update',
    'permission' => 'general-sitb-child-tb-score6.sitb-child-tb-score6.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1199 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbChildTbScore6\\Http\\Controllers\\SitbChildTbScore6Controller@destroy',
    'permission' => 'general-sitb-child-tb-score6.sitb-child-tb-score6.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1200 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbDiagnosisType\\Http\\Controllers\\SitbDiagnosisTypeController@index',
    'permission' => 'general-sitb-diagnosis-type.sitb-diagnosis-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1201 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbDiagnosisType\\Http\\Controllers\\SitbDiagnosisTypeController@show',
    'permission' => 'general-sitb-diagnosis-type.sitb-diagnosis-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1202 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbDiagnosisType\\Http\\Controllers\\SitbDiagnosisTypeController@store',
    'permission' => 'general-sitb-diagnosis-type.sitb-diagnosis-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1203 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbDiagnosisType\\Http\\Controllers\\SitbDiagnosisTypeController@update',
    'permission' => 'general-sitb-diagnosis-type.sitb-diagnosis-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1204 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbDiagnosisType\\Http\\Controllers\\SitbDiagnosisTypeController@destroy',
    'permission' => 'general-sitb-diagnosis-type.sitb-diagnosis-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1205 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbDm\\Http\\Controllers\\SitbDmController@index',
    'permission' => 'general-sitb-dm.sitb-dm.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1206 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbDm\\Http\\Controllers\\SitbDmController@show',
    'permission' => 'general-sitb-dm.sitb-dm.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1207 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbDm\\Http\\Controllers\\SitbDmController@store',
    'permission' => 'general-sitb-dm.sitb-dm.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1208 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbDm\\Http\\Controllers\\SitbDmController@update',
    'permission' => 'general-sitb-dm.sitb-dm.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1209 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbDm\\Http\\Controllers\\SitbDmController@destroy',
    'permission' => 'general-sitb-dm.sitb-dm.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1210 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbDmTherapy\\Http\\Controllers\\SitbDmTherapyController@index',
    'permission' => 'general-sitb-dm-therapy.sitb-dm-therapy.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1211 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbDmTherapy\\Http\\Controllers\\SitbDmTherapyController@show',
    'permission' => 'general-sitb-dm-therapy.sitb-dm-therapy.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1212 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbDmTherapy\\Http\\Controllers\\SitbDmTherapyController@store',
    'permission' => 'general-sitb-dm-therapy.sitb-dm-therapy.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1213 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbDmTherapy\\Http\\Controllers\\SitbDmTherapyController@update',
    'permission' => 'general-sitb-dm-therapy.sitb-dm-therapy.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1214 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbDmTherapy\\Http\\Controllers\\SitbDmTherapyController@destroy',
    'permission' => 'general-sitb-dm-therapy.sitb-dm-therapy.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1215 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbDrugSource\\Http\\Controllers\\SitbDrugSourceController@index',
    'permission' => 'general-sitb-drug-source.sitb-drug-source.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1216 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbDrugSource\\Http\\Controllers\\SitbDrugSourceController@show',
    'permission' => 'general-sitb-drug-source.sitb-drug-source.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1217 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbDrugSource\\Http\\Controllers\\SitbDrugSourceController@store',
    'permission' => 'general-sitb-drug-source.sitb-drug-source.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1218 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbDrugSource\\Http\\Controllers\\SitbDrugSourceController@update',
    'permission' => 'general-sitb-drug-source.sitb-drug-source.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1219 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbDrugSource\\Http\\Controllers\\SitbDrugSourceController@destroy',
    'permission' => 'general-sitb-drug-source.sitb-drug-source.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1220 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbEndMicroscopy\\Http\\Controllers\\SitbEndMicroscopyController@index',
    'permission' => 'general-sitb-end-microscopy.sitb-end-microscopy.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1221 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbEndMicroscopy\\Http\\Controllers\\SitbEndMicroscopyController@show',
    'permission' => 'general-sitb-end-microscopy.sitb-end-microscopy.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1222 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbEndMicroscopy\\Http\\Controllers\\SitbEndMicroscopyController@store',
    'permission' => 'general-sitb-end-microscopy.sitb-end-microscopy.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1223 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbEndMicroscopy\\Http\\Controllers\\SitbEndMicroscopyController@update',
    'permission' => 'general-sitb-end-microscopy.sitb-end-microscopy.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1224 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbEndMicroscopy\\Http\\Controllers\\SitbEndMicroscopyController@destroy',
    'permission' => 'general-sitb-end-microscopy.sitb-end-microscopy.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1225 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbHivStatusClassification\\Http\\Controllers\\SitbHivStatusClassificationController@index',
    'permission' => 'general-sitb-hiv-status-classification.sitb-hiv-status-classification.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1226 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbHivStatusClassification\\Http\\Controllers\\SitbHivStatusClassificationController@show',
    'permission' => 'general-sitb-hiv-status-classification.sitb-hiv-status-classification.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1227 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbHivStatusClassification\\Http\\Controllers\\SitbHivStatusClassificationController@store',
    'permission' => 'general-sitb-hiv-status-classification.sitb-hiv-status-classification.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1228 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbHivStatusClassification\\Http\\Controllers\\SitbHivStatusClassificationController@update',
    'permission' => 'general-sitb-hiv-status-classification.sitb-hiv-status-classification.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1229 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbHivStatusClassification\\Http\\Controllers\\SitbHivStatusClassificationController@destroy',
    'permission' => 'general-sitb-hiv-status-classification.sitb-hiv-status-classification.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1230 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbHivTestResult\\Http\\Controllers\\SitbHivTestResultController@index',
    'permission' => 'general-sitb-hiv-test-result.sitb-hiv-test-result.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1231 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbHivTestResult\\Http\\Controllers\\SitbHivTestResultController@show',
    'permission' => 'general-sitb-hiv-test-result.sitb-hiv-test-result.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1232 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbHivTestResult\\Http\\Controllers\\SitbHivTestResultController@store',
    'permission' => 'general-sitb-hiv-test-result.sitb-hiv-test-result.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1233 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbHivTestResult\\Http\\Controllers\\SitbHivTestResultController@update',
    'permission' => 'general-sitb-hiv-test-result.sitb-hiv-test-result.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1234 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbHivTestResult\\Http\\Controllers\\SitbHivTestResultController@destroy',
    'permission' => 'general-sitb-hiv-test-result.sitb-hiv-test-result.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1235 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbMonth2Microscopy\\Http\\Controllers\\SitbMonth2MicroscopyController@index',
    'permission' => 'general-sitb-month2-microscopy.sitb-month2-microscopy.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1236 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbMonth2Microscopy\\Http\\Controllers\\SitbMonth2MicroscopyController@show',
    'permission' => 'general-sitb-month2-microscopy.sitb-month2-microscopy.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1237 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbMonth2Microscopy\\Http\\Controllers\\SitbMonth2MicroscopyController@store',
    'permission' => 'general-sitb-month2-microscopy.sitb-month2-microscopy.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1238 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbMonth2Microscopy\\Http\\Controllers\\SitbMonth2MicroscopyController@update',
    'permission' => 'general-sitb-month2-microscopy.sitb-month2-microscopy.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1239 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbMonth2Microscopy\\Http\\Controllers\\SitbMonth2MicroscopyController@destroy',
    'permission' => 'general-sitb-month2-microscopy.sitb-month2-microscopy.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1240 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbMonth3Microscopy\\Http\\Controllers\\SitbMonth3MicroscopyController@index',
    'permission' => 'general-sitb-month3-microscopy.sitb-month3-microscopy.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1241 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbMonth3Microscopy\\Http\\Controllers\\SitbMonth3MicroscopyController@show',
    'permission' => 'general-sitb-month3-microscopy.sitb-month3-microscopy.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1242 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbMonth3Microscopy\\Http\\Controllers\\SitbMonth3MicroscopyController@store',
    'permission' => 'general-sitb-month3-microscopy.sitb-month3-microscopy.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1243 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbMonth3Microscopy\\Http\\Controllers\\SitbMonth3MicroscopyController@update',
    'permission' => 'general-sitb-month3-microscopy.sitb-month3-microscopy.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1244 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbMonth3Microscopy\\Http\\Controllers\\SitbMonth3MicroscopyController@destroy',
    'permission' => 'general-sitb-month3-microscopy.sitb-month3-microscopy.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1245 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbMonth5Microscopy\\Http\\Controllers\\SitbMonth5MicroscopyController@index',
    'permission' => 'general-sitb-month5-microscopy.sitb-month5-microscopy.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1246 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbMonth5Microscopy\\Http\\Controllers\\SitbMonth5MicroscopyController@show',
    'permission' => 'general-sitb-month5-microscopy.sitb-month5-microscopy.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1247 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbMonth5Microscopy\\Http\\Controllers\\SitbMonth5MicroscopyController@store',
    'permission' => 'general-sitb-month5-microscopy.sitb-month5-microscopy.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1248 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbMonth5Microscopy\\Http\\Controllers\\SitbMonth5MicroscopyController@update',
    'permission' => 'general-sitb-month5-microscopy.sitb-month5-microscopy.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1249 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbMonth5Microscopy\\Http\\Controllers\\SitbMonth5MicroscopyController@destroy',
    'permission' => 'general-sitb-month5-microscopy.sitb-month5-microscopy.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1250 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbOatGuideline\\Http\\Controllers\\SitbOatGuidelineController@index',
    'permission' => 'general-sitb-oat-guideline.sitb-oat-guideline.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1251 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbOatGuideline\\Http\\Controllers\\SitbOatGuidelineController@show',
    'permission' => 'general-sitb-oat-guideline.sitb-oat-guideline.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1252 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbOatGuideline\\Http\\Controllers\\SitbOatGuidelineController@store',
    'permission' => 'general-sitb-oat-guideline.sitb-oat-guideline.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1253 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbOatGuideline\\Http\\Controllers\\SitbOatGuidelineController@update',
    'permission' => 'general-sitb-oat-guideline.sitb-oat-guideline.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1254 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbOatGuideline\\Http\\Controllers\\SitbOatGuidelineController@destroy',
    'permission' => 'general-sitb-oat-guideline.sitb-oat-guideline.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1255 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbPpk\\Http\\Controllers\\SitbPpkController@index',
    'permission' => 'general-sitb-ppk.sitb-ppk.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1256 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbPpk\\Http\\Controllers\\SitbPpkController@show',
    'permission' => 'general-sitb-ppk.sitb-ppk.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1257 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbPpk\\Http\\Controllers\\SitbPpkController@store',
    'permission' => 'general-sitb-ppk.sitb-ppk.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1258 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbPpk\\Http\\Controllers\\SitbPpkController@update',
    'permission' => 'general-sitb-ppk.sitb-ppk.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1259 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbPpk\\Http\\Controllers\\SitbPpkController@destroy',
    'permission' => 'general-sitb-ppk.sitb-ppk.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1260 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbPreCulture\\Http\\Controllers\\SitbPreCultureController@index',
    'permission' => 'general-sitb-pre-culture.sitb-pre-culture.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1261 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbPreCulture\\Http\\Controllers\\SitbPreCultureController@show',
    'permission' => 'general-sitb-pre-culture.sitb-pre-culture.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1262 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbPreCulture\\Http\\Controllers\\SitbPreCultureController@store',
    'permission' => 'general-sitb-pre-culture.sitb-pre-culture.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1263 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbPreCulture\\Http\\Controllers\\SitbPreCultureController@update',
    'permission' => 'general-sitb-pre-culture.sitb-pre-culture.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1264 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbPreCulture\\Http\\Controllers\\SitbPreCultureController@destroy',
    'permission' => 'general-sitb-pre-culture.sitb-pre-culture.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1265 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbPreMicroscopy\\Http\\Controllers\\SitbPreMicroscopyController@index',
    'permission' => 'general-sitb-pre-microscopy.sitb-pre-microscopy.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1266 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbPreMicroscopy\\Http\\Controllers\\SitbPreMicroscopyController@show',
    'permission' => 'general-sitb-pre-microscopy.sitb-pre-microscopy.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1267 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbPreMicroscopy\\Http\\Controllers\\SitbPreMicroscopyController@store',
    'permission' => 'general-sitb-pre-microscopy.sitb-pre-microscopy.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1268 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbPreMicroscopy\\Http\\Controllers\\SitbPreMicroscopyController@update',
    'permission' => 'general-sitb-pre-microscopy.sitb-pre-microscopy.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1269 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbPreMicroscopy\\Http\\Controllers\\SitbPreMicroscopyController@destroy',
    'permission' => 'general-sitb-pre-microscopy.sitb-pre-microscopy.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1270 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbPreTcm\\Http\\Controllers\\SitbPreTcmController@index',
    'permission' => 'general-sitb-pre-tcm.sitb-pre-tcm.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1271 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbPreTcm\\Http\\Controllers\\SitbPreTcmController@show',
    'permission' => 'general-sitb-pre-tcm.sitb-pre-tcm.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1272 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbPreTcm\\Http\\Controllers\\SitbPreTcmController@store',
    'permission' => 'general-sitb-pre-tcm.sitb-pre-tcm.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1273 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbPreTcm\\Http\\Controllers\\SitbPreTcmController@update',
    'permission' => 'general-sitb-pre-tcm.sitb-pre-tcm.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1274 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbPreTcm\\Http\\Controllers\\SitbPreTcmController@destroy',
    'permission' => 'general-sitb-pre-tcm.sitb-pre-tcm.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1275 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbReferrerType\\Http\\Controllers\\SitbReferrerTypeController@index',
    'permission' => 'general-sitb-referrer-type.sitb-referrer-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1276 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbReferrerType\\Http\\Controllers\\SitbReferrerTypeController@show',
    'permission' => 'general-sitb-referrer-type.sitb-referrer-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1277 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbReferrerType\\Http\\Controllers\\SitbReferrerTypeController@store',
    'permission' => 'general-sitb-referrer-type.sitb-referrer-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1278 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbReferrerType\\Http\\Controllers\\SitbReferrerTypeController@update',
    'permission' => 'general-sitb-referrer-type.sitb-referrer-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1279 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbReferrerType\\Http\\Controllers\\SitbReferrerTypeController@destroy',
    'permission' => 'general-sitb-referrer-type.sitb-referrer-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1280 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbTb03RoTransfer\\Http\\Controllers\\SitbTb03RoTransferController@index',
    'permission' => 'general-sitb-tb03-ro-transfer.sitb-tb03-ro-transfer.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1281 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbTb03RoTransfer\\Http\\Controllers\\SitbTb03RoTransferController@show',
    'permission' => 'general-sitb-tb03-ro-transfer.sitb-tb03-ro-transfer.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1282 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbTb03RoTransfer\\Http\\Controllers\\SitbTb03RoTransferController@store',
    'permission' => 'general-sitb-tb03-ro-transfer.sitb-tb03-ro-transfer.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1283 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbTb03RoTransfer\\Http\\Controllers\\SitbTb03RoTransferController@update',
    'permission' => 'general-sitb-tb03-ro-transfer.sitb-tb03-ro-transfer.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1284 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbTb03RoTransfer\\Http\\Controllers\\SitbTb03RoTransferController@destroy',
    'permission' => 'general-sitb-tb03-ro-transfer.sitb-tb03-ro-transfer.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1285 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbThoraxNotDone\\Http\\Controllers\\SitbThoraxNotDoneController@index',
    'permission' => 'general-sitb-thorax-not-done.sitb-thorax-not-done.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1286 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbThoraxNotDone\\Http\\Controllers\\SitbThoraxNotDoneController@show',
    'permission' => 'general-sitb-thorax-not-done.sitb-thorax-not-done.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1287 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbThoraxNotDone\\Http\\Controllers\\SitbThoraxNotDoneController@store',
    'permission' => 'general-sitb-thorax-not-done.sitb-thorax-not-done.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1288 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbThoraxNotDone\\Http\\Controllers\\SitbThoraxNotDoneController@update',
    'permission' => 'general-sitb-thorax-not-done.sitb-thorax-not-done.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1289 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbThoraxNotDone\\Http\\Controllers\\SitbThoraxNotDoneController@destroy',
    'permission' => 'general-sitb-thorax-not-done.sitb-thorax-not-done.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1290 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbTreatmentHistoryClassification\\Http\\Controllers\\SitbTreatmentHistoryClassificationController@index',
    'permission' => 'general-sitb-treatment-history-classification.sitb-treatment-history-classification.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1291 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbTreatmentHistoryClassification\\Http\\Controllers\\SitbTreatmentHistoryClassificationController@show',
    'permission' => 'general-sitb-treatment-history-classification.sitb-treatment-history-classification.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1292 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbTreatmentHistoryClassification\\Http\\Controllers\\SitbTreatmentHistoryClassificationController@store',
    'permission' => 'general-sitb-treatment-history-classification.sitb-treatment-history-classification.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1293 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbTreatmentHistoryClassification\\Http\\Controllers\\SitbTreatmentHistoryClassificationController@update',
    'permission' => 'general-sitb-treatment-history-classification.sitb-treatment-history-classification.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1294 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbTreatmentHistoryClassification\\Http\\Controllers\\SitbTreatmentHistoryClassificationController@destroy',
    'permission' => 'general-sitb-treatment-history-classification.sitb-treatment-history-classification.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1295 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbTreatmentOutcome\\Http\\Controllers\\SitbTreatmentOutcomeController@index',
    'permission' => 'general-sitb-treatment-outcome.sitb-treatment-outcome.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1296 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbTreatmentOutcome\\Http\\Controllers\\SitbTreatmentOutcomeController@show',
    'permission' => 'general-sitb-treatment-outcome.sitb-treatment-outcome.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1297 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbTreatmentOutcome\\Http\\Controllers\\SitbTreatmentOutcomeController@store',
    'permission' => 'general-sitb-treatment-outcome.sitb-treatment-outcome.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1298 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbTreatmentOutcome\\Http\\Controllers\\SitbTreatmentOutcomeController@update',
    'permission' => 'general-sitb-treatment-outcome.sitb-treatment-outcome.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1299 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbTreatmentOutcome\\Http\\Controllers\\SitbTreatmentOutcomeController@destroy',
    'permission' => 'general-sitb-treatment-outcome.sitb-treatment-outcome.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1300 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbTreatmentStatus\\Http\\Controllers\\SitbTreatmentStatusController@index',
    'permission' => 'general-sitb-treatment-status.sitb-treatment-status.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1301 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbTreatmentStatus\\Http\\Controllers\\SitbTreatmentStatusController@show',
    'permission' => 'general-sitb-treatment-status.sitb-treatment-status.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1302 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbTreatmentStatus\\Http\\Controllers\\SitbTreatmentStatusController@store',
    'permission' => 'general-sitb-treatment-status.sitb-treatment-status.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1303 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbTreatmentStatus\\Http\\Controllers\\SitbTreatmentStatusController@update',
    'permission' => 'general-sitb-treatment-status.sitb-treatment-status.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1304 => 
  array (
    'controller_action' => 'Modules\\GeneralSitbTreatmentStatus\\Http\\Controllers\\SitbTreatmentStatusController@destroy',
    'permission' => 'general-sitb-treatment-status.sitb-treatment-status.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1305 => 
  array (
    'controller_action' => 'Modules\\GeneralStaffMember\\Http\\Controllers\\StaffMemberController@index',
    'permission' => 'general-staff-member.staff-member.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1306 => 
  array (
    'controller_action' => 'Modules\\GeneralStaffMember\\Http\\Controllers\\StaffMemberController@show',
    'permission' => 'general-staff-member.staff-member.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1307 => 
  array (
    'controller_action' => 'Modules\\GeneralStaffMember\\Http\\Controllers\\StaffMemberController@store',
    'permission' => 'general-staff-member.staff-member.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1308 => 
  array (
    'controller_action' => 'Modules\\GeneralStaffMember\\Http\\Controllers\\StaffMemberController@update',
    'permission' => 'general-staff-member.staff-member.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1309 => 
  array (
    'controller_action' => 'Modules\\GeneralStaffMember\\Http\\Controllers\\StaffMemberController@destroy',
    'permission' => 'general-staff-member.staff-member.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1310 => 
  array (
    'controller_action' => 'Modules\\GeneralStaffWardAssignment\\Http\\Controllers\\StaffWardAssignmentController@index',
    'permission' => 'general-staff-ward-assignment.staff-ward-assignment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1311 => 
  array (
    'controller_action' => 'Modules\\GeneralStaffWardAssignment\\Http\\Controllers\\StaffWardAssignmentController@show',
    'permission' => 'general-staff-ward-assignment.staff-ward-assignment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1312 => 
  array (
    'controller_action' => 'Modules\\GeneralStaffWardAssignment\\Http\\Controllers\\StaffWardAssignmentController@store',
    'permission' => 'general-staff-ward-assignment.staff-ward-assignment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1313 => 
  array (
    'controller_action' => 'Modules\\GeneralStaffWardAssignment\\Http\\Controllers\\StaffWardAssignmentController@update',
    'permission' => 'general-staff-ward-assignment.staff-ward-assignment.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1314 => 
  array (
    'controller_action' => 'Modules\\GeneralStaffWardAssignment\\Http\\Controllers\\StaffWardAssignmentController@destroy',
    'permission' => 'general-staff-ward-assignment.staff-ward-assignment.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1315 => 
  array (
    'controller_action' => 'Modules\\GeneralTariffType\\Http\\Controllers\\TariffTypeController@index',
    'permission' => 'general-tariff-type.tariff-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1316 => 
  array (
    'controller_action' => 'Modules\\GeneralTariffType\\Http\\Controllers\\TariffTypeController@show',
    'permission' => 'general-tariff-type.tariff-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1317 => 
  array (
    'controller_action' => 'Modules\\GeneralTariffType\\Http\\Controllers\\TariffTypeController@store',
    'permission' => 'general-tariff-type.tariff-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1318 => 
  array (
    'controller_action' => 'Modules\\GeneralTariffType\\Http\\Controllers\\TariffTypeController@update',
    'permission' => 'general-tariff-type.tariff-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1319 => 
  array (
    'controller_action' => 'Modules\\GeneralTariffType\\Http\\Controllers\\TariffTypeController@destroy',
    'permission' => 'general-tariff-type.tariff-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1320 => 
  array (
    'controller_action' => 'Modules\\GeneralTbPatientCategory\\Http\\Controllers\\TbPatientCategoryController@index',
    'permission' => 'general-tb-patient-category.tb-patient-category.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1321 => 
  array (
    'controller_action' => 'Modules\\GeneralTbPatientCategory\\Http\\Controllers\\TbPatientCategoryController@show',
    'permission' => 'general-tb-patient-category.tb-patient-category.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1322 => 
  array (
    'controller_action' => 'Modules\\GeneralTbPatientCategory\\Http\\Controllers\\TbPatientCategoryController@store',
    'permission' => 'general-tb-patient-category.tb-patient-category.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1323 => 
  array (
    'controller_action' => 'Modules\\GeneralTbPatientCategory\\Http\\Controllers\\TbPatientCategoryController@update',
    'permission' => 'general-tb-patient-category.tb-patient-category.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1324 => 
  array (
    'controller_action' => 'Modules\\GeneralTbPatientCategory\\Http\\Controllers\\TbPatientCategoryController@destroy',
    'permission' => 'general-tb-patient-category.tb-patient-category.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1325 => 
  array (
    'controller_action' => 'Modules\\GeneralTreatmentCategory\\Http\\Controllers\\TreatmentCategoryController@index',
    'permission' => 'general-treatment-category.treatment-category.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1326 => 
  array (
    'controller_action' => 'Modules\\GeneralTreatmentCategory\\Http\\Controllers\\TreatmentCategoryController@show',
    'permission' => 'general-treatment-category.treatment-category.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1327 => 
  array (
    'controller_action' => 'Modules\\GeneralTreatmentCategory\\Http\\Controllers\\TreatmentCategoryController@store',
    'permission' => 'general-treatment-category.treatment-category.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1328 => 
  array (
    'controller_action' => 'Modules\\GeneralTreatmentCategory\\Http\\Controllers\\TreatmentCategoryController@update',
    'permission' => 'general-treatment-category.treatment-category.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1329 => 
  array (
    'controller_action' => 'Modules\\GeneralTreatmentCategory\\Http\\Controllers\\TreatmentCategoryController@destroy',
    'permission' => 'general-treatment-category.treatment-category.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1330 => 
  array (
    'controller_action' => 'Modules\\GeneralUserGroup\\Http\\Controllers\\UserGroupController@index',
    'permission' => 'general-user-group.user-group.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1331 => 
  array (
    'controller_action' => 'Modules\\GeneralUserGroup\\Http\\Controllers\\UserGroupController@show',
    'permission' => 'general-user-group.user-group.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1332 => 
  array (
    'controller_action' => 'Modules\\GeneralUserGroup\\Http\\Controllers\\UserGroupController@store',
    'permission' => 'general-user-group.user-group.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1333 => 
  array (
    'controller_action' => 'Modules\\GeneralUserGroup\\Http\\Controllers\\UserGroupController@update',
    'permission' => 'general-user-group.user-group.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1334 => 
  array (
    'controller_action' => 'Modules\\GeneralUserGroup\\Http\\Controllers\\UserGroupController@destroy',
    'permission' => 'general-user-group.user-group.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1335 => 
  array (
    'controller_action' => 'Modules\\GeneralUserType\\Http\\Controllers\\UserTypeController@index',
    'permission' => 'general-user-type.user-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1336 => 
  array (
    'controller_action' => 'Modules\\GeneralUserType\\Http\\Controllers\\UserTypeController@show',
    'permission' => 'general-user-type.user-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1337 => 
  array (
    'controller_action' => 'Modules\\GeneralUserType\\Http\\Controllers\\UserTypeController@store',
    'permission' => 'general-user-type.user-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1338 => 
  array (
    'controller_action' => 'Modules\\GeneralUserType\\Http\\Controllers\\UserTypeController@update',
    'permission' => 'general-user-type.user-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1339 => 
  array (
    'controller_action' => 'Modules\\GeneralUserType\\Http\\Controllers\\UserTypeController@destroy',
    'permission' => 'general-user-type.user-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1340 => 
  array (
    'controller_action' => 'Modules\\GeneralVideoAttachment\\Http\\Controllers\\VideoAttachmentController@index',
    'permission' => 'general-video-attachment.video-attachment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1341 => 
  array (
    'controller_action' => 'Modules\\GeneralVideoAttachment\\Http\\Controllers\\VideoAttachmentController@show',
    'permission' => 'general-video-attachment.video-attachment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1342 => 
  array (
    'controller_action' => 'Modules\\GeneralVideoAttachment\\Http\\Controllers\\VideoAttachmentController@store',
    'permission' => 'general-video-attachment.video-attachment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1343 => 
  array (
    'controller_action' => 'Modules\\GeneralVideoAttachment\\Http\\Controllers\\VideoAttachmentController@update',
    'permission' => 'general-video-attachment.video-attachment.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1344 => 
  array (
    'controller_action' => 'Modules\\GeneralVideoAttachment\\Http\\Controllers\\VideoAttachmentController@destroy',
    'permission' => 'general-video-attachment.video-attachment.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1345 => 
  array (
    'controller_action' => 'Modules\\GeneralVisitActivityStatus\\Http\\Controllers\\VisitActivityStatusController@index',
    'permission' => 'general-visit-activity-status.visit-activity-status.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1346 => 
  array (
    'controller_action' => 'Modules\\GeneralVisitActivityStatus\\Http\\Controllers\\VisitActivityStatusController@show',
    'permission' => 'general-visit-activity-status.visit-activity-status.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1347 => 
  array (
    'controller_action' => 'Modules\\GeneralVisitActivityStatus\\Http\\Controllers\\VisitActivityStatusController@store',
    'permission' => 'general-visit-activity-status.visit-activity-status.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1348 => 
  array (
    'controller_action' => 'Modules\\GeneralVisitActivityStatus\\Http\\Controllers\\VisitActivityStatusController@update',
    'permission' => 'general-visit-activity-status.visit-activity-status.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1349 => 
  array (
    'controller_action' => 'Modules\\GeneralVisitActivityStatus\\Http\\Controllers\\VisitActivityStatusController@destroy',
    'permission' => 'general-visit-activity-status.visit-activity-status.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1350 => 
  array (
    'controller_action' => 'Modules\\GeneralVisitCancellationReason\\Http\\Controllers\\VisitCancellationReasonController@index',
    'permission' => 'general-visit-cancellation-reason.visit-cancellation-reason.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1351 => 
  array (
    'controller_action' => 'Modules\\GeneralVisitCancellationReason\\Http\\Controllers\\VisitCancellationReasonController@show',
    'permission' => 'general-visit-cancellation-reason.visit-cancellation-reason.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1352 => 
  array (
    'controller_action' => 'Modules\\GeneralVisitCancellationReason\\Http\\Controllers\\VisitCancellationReasonController@store',
    'permission' => 'general-visit-cancellation-reason.visit-cancellation-reason.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1353 => 
  array (
    'controller_action' => 'Modules\\GeneralVisitCancellationReason\\Http\\Controllers\\VisitCancellationReasonController@update',
    'permission' => 'general-visit-cancellation-reason.visit-cancellation-reason.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1354 => 
  array (
    'controller_action' => 'Modules\\GeneralVisitCancellationReason\\Http\\Controllers\\VisitCancellationReasonController@destroy',
    'permission' => 'general-visit-cancellation-reason.visit-cancellation-reason.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1355 => 
  array (
    'controller_action' => 'Modules\\GeneralVisitStatus\\Http\\Controllers\\VisitStatusController@index',
    'permission' => 'general-visit-status.visit-status.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1356 => 
  array (
    'controller_action' => 'Modules\\GeneralVisitStatus\\Http\\Controllers\\VisitStatusController@show',
    'permission' => 'general-visit-status.visit-status.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1357 => 
  array (
    'controller_action' => 'Modules\\GeneralVisitStatus\\Http\\Controllers\\VisitStatusController@store',
    'permission' => 'general-visit-status.visit-status.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1358 => 
  array (
    'controller_action' => 'Modules\\GeneralVisitStatus\\Http\\Controllers\\VisitStatusController@update',
    'permission' => 'general-visit-status.visit-status.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1359 => 
  array (
    'controller_action' => 'Modules\\GeneralVisitStatus\\Http\\Controllers\\VisitStatusController@destroy',
    'permission' => 'general-visit-status.visit-status.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1360 => 
  array (
    'controller_action' => 'Modules\\GeneralVisitType\\Http\\Controllers\\VisitTypeController@index',
    'permission' => 'general-visit-type.visit-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1361 => 
  array (
    'controller_action' => 'Modules\\GeneralVisitType\\Http\\Controllers\\VisitTypeController@show',
    'permission' => 'general-visit-type.visit-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1362 => 
  array (
    'controller_action' => 'Modules\\GeneralVisitType\\Http\\Controllers\\VisitTypeController@store',
    'permission' => 'general-visit-type.visit-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1363 => 
  array (
    'controller_action' => 'Modules\\GeneralVisitType\\Http\\Controllers\\VisitTypeController@update',
    'permission' => 'general-visit-type.visit-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1364 => 
  array (
    'controller_action' => 'Modules\\GeneralVisitType\\Http\\Controllers\\VisitTypeController@destroy',
    'permission' => 'general-visit-type.visit-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1365 => 
  array (
    'controller_action' => 'Modules\\GeneralWard\\Http\\Controllers\\WardController@index',
    'permission' => 'general-ward.ward.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1366 => 
  array (
    'controller_action' => 'Modules\\GeneralWard\\Http\\Controllers\\WardController@show',
    'permission' => 'general-ward.ward.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1367 => 
  array (
    'controller_action' => 'Modules\\GeneralWard\\Http\\Controllers\\WardController@store',
    'permission' => 'general-ward.ward.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1368 => 
  array (
    'controller_action' => 'Modules\\GeneralWard\\Http\\Controllers\\WardController@update',
    'permission' => 'general-ward.ward.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1369 => 
  array (
    'controller_action' => 'Modules\\GeneralWard\\Http\\Controllers\\WardController@destroy',
    'permission' => 'general-ward.ward.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1370 => 
  array (
    'controller_action' => 'Modules\\GeneralWardClassAssignment\\Http\\Controllers\\GeneralWardClassAssignmentController@index',
    'permission' => 'general-ward-class-assignment.general-ward-class-assignment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1371 => 
  array (
    'controller_action' => 'Modules\\GeneralWardClassAssignment\\Http\\Controllers\\GeneralWardClassAssignmentController@show',
    'permission' => 'general-ward-class-assignment.general-ward-class-assignment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1372 => 
  array (
    'controller_action' => 'Modules\\GeneralWardClassAssignment\\Http\\Controllers\\GeneralWardClassAssignmentController@store',
    'permission' => 'general-ward-class-assignment.general-ward-class-assignment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1373 => 
  array (
    'controller_action' => 'Modules\\GeneralWardClassAssignment\\Http\\Controllers\\GeneralWardClassAssignmentController@update',
    'permission' => 'general-ward-class-assignment.general-ward-class-assignment.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1374 => 
  array (
    'controller_action' => 'Modules\\GeneralWardClassAssignment\\Http\\Controllers\\GeneralWardClassAssignmentController@destroy',
    'permission' => 'general-ward-class-assignment.general-ward-class-assignment.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1375 => 
  array (
    'controller_action' => 'Modules\\GeneralWardService\\Http\\Controllers\\WardServiceController@index',
    'permission' => 'general-ward-service.ward-service.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1376 => 
  array (
    'controller_action' => 'Modules\\GeneralWardService\\Http\\Controllers\\WardServiceController@show',
    'permission' => 'general-ward-service.ward-service.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1377 => 
  array (
    'controller_action' => 'Modules\\GeneralWardService\\Http\\Controllers\\WardServiceController@store',
    'permission' => 'general-ward-service.ward-service.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1378 => 
  array (
    'controller_action' => 'Modules\\GeneralWardService\\Http\\Controllers\\WardServiceController@update',
    'permission' => 'general-ward-service.ward-service.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1379 => 
  array (
    'controller_action' => 'Modules\\GeneralWardService\\Http\\Controllers\\WardServiceController@destroy',
    'permission' => 'general-ward-service.ward-service.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1380 => 
  array (
    'controller_action' => 'Modules\\GeneralWardTariff\\Http\\Controllers\\WardTariffController@index',
    'permission' => 'general-ward-tariff.ward-tariff.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1381 => 
  array (
    'controller_action' => 'Modules\\GeneralWardTariff\\Http\\Controllers\\WardTariffController@store',
    'permission' => 'general-ward-tariff.ward-tariff.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1382 => 
  array (
    'controller_action' => 'Modules\\GeneralWardTariff\\Http\\Controllers\\WardTariffController@show',
    'permission' => 'general-ward-tariff.ward-tariff.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1383 => 
  array (
    'controller_action' => 'Modules\\GeneralWardTariff\\Http\\Controllers\\WardTariffController@update',
    'permission' => 'general-ward-tariff.ward-tariff.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1384 => 
  array (
    'controller_action' => 'Modules\\GeneralWardTariff\\Http\\Controllers\\WardTariffController@destroy',
    'permission' => 'general-ward-tariff.ward-tariff.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1385 => 
  array (
    'controller_action' => 'Modules\\GeneralWardTransferRoute\\Http\\Controllers\\WardTransferRouteController@index',
    'permission' => 'general-ward-transfer-route.ward-transfer-route.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1386 => 
  array (
    'controller_action' => 'Modules\\GeneralWardTransferRoute\\Http\\Controllers\\WardTransferRouteController@show',
    'permission' => 'general-ward-transfer-route.ward-transfer-route.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1387 => 
  array (
    'controller_action' => 'Modules\\GeneralWardTransferRoute\\Http\\Controllers\\WardTransferRouteController@store',
    'permission' => 'general-ward-transfer-route.ward-transfer-route.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1388 => 
  array (
    'controller_action' => 'Modules\\GeneralWardTransferRoute\\Http\\Controllers\\WardTransferRouteController@update',
    'permission' => 'general-ward-transfer-route.ward-transfer-route.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1389 => 
  array (
    'controller_action' => 'Modules\\GeneralWardTransferRoute\\Http\\Controllers\\WardTransferRouteController@destroy',
    'permission' => 'general-ward-transfer-route.ward-transfer-route.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1390 => 
  array (
    'controller_action' => 'Modules\\GeneralWardType\\Http\\Controllers\\WardTypeController@index',
    'permission' => 'general-ward-type.ward-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1391 => 
  array (
    'controller_action' => 'Modules\\GeneralWardType\\Http\\Controllers\\WardTypeController@show',
    'permission' => 'general-ward-type.ward-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1392 => 
  array (
    'controller_action' => 'Modules\\GeneralWardType\\Http\\Controllers\\WardTypeController@store',
    'permission' => 'general-ward-type.ward-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1393 => 
  array (
    'controller_action' => 'Modules\\GeneralWardType\\Http\\Controllers\\WardTypeController@update',
    'permission' => 'general-ward-type.ward-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1394 => 
  array (
    'controller_action' => 'Modules\\GeneralWardType\\Http\\Controllers\\WardTypeController@destroy',
    'permission' => 'general-ward-type.ward-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1395 => 
  array (
    'controller_action' => 'Modules\\GeneralWardVisitType\\Http\\Controllers\\WardVisitTypeController@index',
    'permission' => 'general-ward-visit-type.ward-visit-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1396 => 
  array (
    'controller_action' => 'Modules\\GeneralWardVisitType\\Http\\Controllers\\WardVisitTypeController@show',
    'permission' => 'general-ward-visit-type.ward-visit-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1397 => 
  array (
    'controller_action' => 'Modules\\GeneralWardVisitType\\Http\\Controllers\\WardVisitTypeController@store',
    'permission' => 'general-ward-visit-type.ward-visit-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1398 => 
  array (
    'controller_action' => 'Modules\\GeneralWardVisitType\\Http\\Controllers\\WardVisitTypeController@update',
    'permission' => 'general-ward-visit-type.ward-visit-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1399 => 
  array (
    'controller_action' => 'Modules\\GeneralWardVisitType\\Http\\Controllers\\WardVisitTypeController@destroy',
    'permission' => 'general-ward-visit-type.ward-visit-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1400 => 
  array (
    'controller_action' => 'Modules\\GeneralYesNoOption\\Http\\Controllers\\YesNoOptionController@index',
    'permission' => 'general-yes-no-option.yes-no-option.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1401 => 
  array (
    'controller_action' => 'Modules\\GeneralYesNoOption\\Http\\Controllers\\YesNoOptionController@show',
    'permission' => 'general-yes-no-option.yes-no-option.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1402 => 
  array (
    'controller_action' => 'Modules\\GeneralYesNoOption\\Http\\Controllers\\YesNoOptionController@store',
    'permission' => 'general-yes-no-option.yes-no-option.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1403 => 
  array (
    'controller_action' => 'Modules\\GeneralYesNoOption\\Http\\Controllers\\YesNoOptionController@update',
    'permission' => 'general-yes-no-option.yes-no-option.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1404 => 
  array (
    'controller_action' => 'Modules\\GeneralYesNoOption\\Http\\Controllers\\YesNoOptionController@destroy',
    'permission' => 'general-yes-no-option.yes-no-option.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1405 => 
  array (
    'controller_action' => 'Modules\\Grup\\Http\\Controllers\\GroupContextController@show',
    'permission' => 'grup.group-context.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1406 => 
  array (
    'controller_action' => 'Modules\\Grup\\Http\\Controllers\\GroupContextController@sync',
    'permission' => 'grup.group-context.sync',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  1407 => 
  array (
    'controller_action' => 'Modules\\Grup\\Http\\Controllers\\GroupPatientController@index',
    'permission' => 'grup.group-patient.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1408 => 
  array (
    'controller_action' => 'Modules\\Grup\\Http\\Controllers\\GroupPatientController@show',
    'permission' => 'grup.group-patient.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1409 => 
  array (
    'controller_action' => 'Modules\\Grup\\Http\\Controllers\\GroupReferralController@index',
    'permission' => 'grup.group-referral.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1410 => 
  array (
    'controller_action' => 'Modules\\Grup\\Http\\Controllers\\GroupReferralController@store',
    'permission' => 'grup.group-referral.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1411 => 
  array (
    'controller_action' => 'Modules\\Grup\\Http\\Controllers\\GroupReferralController@update',
    'permission' => 'grup.group-referral.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1412 => 
  array (
    'controller_action' => 'Modules\\Grup\\Http\\Controllers\\RealtimeNotificationController@index',
    'permission' => 'grup.realtime-notification.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1413 => 
  array (
    'controller_action' => 'Modules\\Grup\\Http\\Controllers\\HubRelayController@patients',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  1414 => 
  array (
    'controller_action' => 'Modules\\Grup\\Http\\Controllers\\HubRelayController@patient',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  1415 => 
  array (
    'controller_action' => 'Modules\\Grup\\Http\\Controllers\\HubRelayController@referral',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  1416 => 
  array (
    'controller_action' => 'Modules\\Grup\\Http\\Controllers\\RealtimeNotificationController@store',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  1417 => 
  array (
    'controller_action' => 'Modules\\InventoryBloodBag\\Http\\Controllers\\BloodBagController@index',
    'permission' => 'inventory-blood-bag.blood-bag.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1418 => 
  array (
    'controller_action' => 'Modules\\InventoryBloodBag\\Http\\Controllers\\BloodBagController@show',
    'permission' => 'inventory-blood-bag.blood-bag.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1419 => 
  array (
    'controller_action' => 'Modules\\InventoryBloodBag\\Http\\Controllers\\CrossmatchTestController@index',
    'permission' => 'inventory-blood-bag.crossmatch-test.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1420 => 
  array (
    'controller_action' => 'Modules\\InventoryBloodBag\\Http\\Controllers\\CrossmatchTestController@show',
    'permission' => 'inventory-blood-bag.crossmatch-test.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1421 => 
  array (
    'controller_action' => 'Modules\\InventoryBloodBag\\Http\\Controllers\\BloodBagController@store',
    'permission' => 'inventory-blood-bag.blood-bag.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1422 => 
  array (
    'controller_action' => 'Modules\\InventoryBloodBag\\Http\\Controllers\\BloodBagController@update',
    'permission' => 'inventory-blood-bag.blood-bag.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1423 => 
  array (
    'controller_action' => 'Modules\\InventoryBloodBag\\Http\\Controllers\\BloodBagController@destroy',
    'permission' => 'inventory-blood-bag.blood-bag.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1424 => 
  array (
    'controller_action' => 'Modules\\InventoryBloodBag\\Http\\Controllers\\BloodBagController@crossmatch',
    'permission' => 'inventory-blood-bag.blood-bag.crossmatch',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1425 => 
  array (
    'controller_action' => 'Modules\\InventoryBloodBag\\Http\\Controllers\\BloodBagController@transfuse',
    'permission' => 'inventory-blood-bag.blood-bag.transfuse',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1426 => 
  array (
    'controller_action' => 'Modules\\InventoryBloodBag\\Http\\Controllers\\CrossmatchTestController@release',
    'permission' => 'inventory-blood-bag.crossmatch-test.release',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1427 => 
  array (
    'controller_action' => 'Modules\\InventoryDietOrder\\Http\\Controllers\\DietOrderController@index',
    'permission' => 'inventory-diet-order.diet-order.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1428 => 
  array (
    'controller_action' => 'Modules\\InventoryDietOrder\\Http\\Controllers\\DietOrderController@show',
    'permission' => 'inventory-diet-order.diet-order.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1429 => 
  array (
    'controller_action' => 'Modules\\InventoryDietOrder\\Http\\Controllers\\DietOrderController@store',
    'permission' => 'inventory-diet-order.diet-order.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1430 => 
  array (
    'controller_action' => 'Modules\\InventoryDietOrder\\Http\\Controllers\\DietOrderController@update',
    'permission' => 'inventory-diet-order.diet-order.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1431 => 
  array (
    'controller_action' => 'Modules\\InventoryDietOrder\\Http\\Controllers\\DietOrderController@destroy',
    'permission' => 'inventory-diet-order.diet-order.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1432 => 
  array (
    'controller_action' => 'Modules\\InventoryDietOrder\\Http\\Controllers\\DietOrderController@transitionStatus',
    'permission' => 'inventory-diet-order.diet-order.transition-status',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1433 => 
  array (
    'controller_action' => 'Modules\\InventoryGoodsReceipt\\Http\\Controllers\\GoodsReceiptController@index',
    'permission' => 'inventory-goods-receipt.goods-receipt.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1434 => 
  array (
    'controller_action' => 'Modules\\InventoryGoodsReceipt\\Http\\Controllers\\GoodsReceiptController@show',
    'permission' => 'inventory-goods-receipt.goods-receipt.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1435 => 
  array (
    'controller_action' => 'Modules\\InventoryGoodsReceipt\\Http\\Controllers\\GoodsReceiptController@store',
    'permission' => 'inventory-goods-receipt.goods-receipt.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1436 => 
  array (
    'controller_action' => 'Modules\\InventoryGoodsReceiptCancellation\\Http\\Controllers\\InventoryGoodsReceiptCancellationController@index',
    'permission' => 'inventory-goods-receipt-cancellation.inventory-goods-receipt-cancellation.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1437 => 
  array (
    'controller_action' => 'Modules\\InventoryGoodsReceiptCancellation\\Http\\Controllers\\InventoryGoodsReceiptCancellationController@show',
    'permission' => 'inventory-goods-receipt-cancellation.inventory-goods-receipt-cancellation.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1438 => 
  array (
    'controller_action' => 'Modules\\InventoryGoodsReceiptCancellation\\Http\\Controllers\\InventoryGoodsReceiptCancellationController@store',
    'permission' => 'inventory-goods-receipt-cancellation.inventory-goods-receipt-cancellation.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1439 => 
  array (
    'controller_action' => 'Modules\\InventoryGoodsReturn\\Http\\Controllers\\InventoryGoodsReturnController@index',
    'permission' => 'inventory-goods-return.inventory-goods-return.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1440 => 
  array (
    'controller_action' => 'Modules\\InventoryGoodsReturn\\Http\\Controllers\\InventoryGoodsReturnController@show',
    'permission' => 'inventory-goods-return.inventory-goods-return.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1441 => 
  array (
    'controller_action' => 'Modules\\InventoryGoodsReturn\\Http\\Controllers\\InventoryGoodsReturnController@store',
    'permission' => 'inventory-goods-return.inventory-goods-return.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1442 => 
  array (
    'controller_action' => 'Modules\\InventoryGoodsReturn\\Http\\Controllers\\InventoryGoodsReturnController@update',
    'permission' => 'inventory-goods-return.inventory-goods-return.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1443 => 
  array (
    'controller_action' => 'Modules\\InventoryGoodsReturn\\Http\\Controllers\\InventoryGoodsReturnController@destroy',
    'permission' => 'inventory-goods-return.inventory-goods-return.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1444 => 
  array (
    'controller_action' => 'Modules\\InventoryGoodsReturnItem\\Http\\Controllers\\InventoryGoodsReturnItemController@index',
    'permission' => 'inventory-goods-return-item.inventory-goods-return-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1445 => 
  array (
    'controller_action' => 'Modules\\InventoryGoodsReturnItem\\Http\\Controllers\\InventoryGoodsReturnItemController@show',
    'permission' => 'inventory-goods-return-item.inventory-goods-return-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1446 => 
  array (
    'controller_action' => 'Modules\\InventoryGoodsReturnItem\\Http\\Controllers\\InventoryGoodsReturnItemController@store',
    'permission' => 'inventory-goods-return-item.inventory-goods-return-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1447 => 
  array (
    'controller_action' => 'Modules\\InventoryItem\\Http\\Controllers\\ItemController@index',
    'permission' => 'inventory-item.item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1448 => 
  array (
    'controller_action' => 'Modules\\InventoryItem\\Http\\Controllers\\ItemController@show',
    'permission' => 'inventory-item.item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1449 => 
  array (
    'controller_action' => 'Modules\\InventoryItem\\Http\\Controllers\\ItemController@store',
    'permission' => 'inventory-item.item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1450 => 
  array (
    'controller_action' => 'Modules\\InventoryItem\\Http\\Controllers\\ItemController@update',
    'permission' => 'inventory-item.item.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1451 => 
  array (
    'controller_action' => 'Modules\\InventoryItem\\Http\\Controllers\\ItemController@destroy',
    'permission' => 'inventory-item.item.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1452 => 
  array (
    'controller_action' => 'Modules\\InventoryItem\\Http\\Controllers\\ItemController@adjustStock',
    'permission' => 'inventory-item.item.adjust-stock',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1453 => 
  array (
    'controller_action' => 'Modules\\InventoryItemCategory\\Http\\Controllers\\InventoryItemCategoryController@index',
    'permission' => 'inventory-item-category.inventory-item-category.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1454 => 
  array (
    'controller_action' => 'Modules\\InventoryItemCategory\\Http\\Controllers\\InventoryItemCategoryController@show',
    'permission' => 'inventory-item-category.inventory-item-category.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1455 => 
  array (
    'controller_action' => 'Modules\\InventoryItemCategory\\Http\\Controllers\\InventoryItemCategoryController@store',
    'permission' => 'inventory-item-category.inventory-item-category.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1456 => 
  array (
    'controller_action' => 'Modules\\InventoryItemCategory\\Http\\Controllers\\InventoryItemCategoryController@update',
    'permission' => 'inventory-item-category.inventory-item-category.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1457 => 
  array (
    'controller_action' => 'Modules\\InventoryItemCategory\\Http\\Controllers\\InventoryItemCategoryController@destroy',
    'permission' => 'inventory-item-category.inventory-item-category.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1458 => 
  array (
    'controller_action' => 'Modules\\InventoryItemClassification\\Http\\Controllers\\InventoryItemClassificationController@index',
    'permission' => 'inventory-item-classification.inventory-item-classification.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1459 => 
  array (
    'controller_action' => 'Modules\\InventoryItemClassification\\Http\\Controllers\\InventoryItemClassificationController@show',
    'permission' => 'inventory-item-classification.inventory-item-classification.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1460 => 
  array (
    'controller_action' => 'Modules\\InventoryItemClassification\\Http\\Controllers\\InventoryItemClassificationController@store',
    'permission' => 'inventory-item-classification.inventory-item-classification.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1461 => 
  array (
    'controller_action' => 'Modules\\InventoryItemClassification\\Http\\Controllers\\InventoryItemClassificationController@update',
    'permission' => 'inventory-item-classification.inventory-item-classification.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1462 => 
  array (
    'controller_action' => 'Modules\\InventoryItemClassification\\Http\\Controllers\\InventoryItemClassificationController@destroy',
    'permission' => 'inventory-item-classification.inventory-item-classification.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1463 => 
  array (
    'controller_action' => 'Modules\\InventoryItemPrice\\Http\\Controllers\\InventoryItemPriceController@index',
    'permission' => 'inventory-item-price.inventory-item-price.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1464 => 
  array (
    'controller_action' => 'Modules\\InventoryItemPrice\\Http\\Controllers\\InventoryItemPriceController@show',
    'permission' => 'inventory-item-price.inventory-item-price.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1465 => 
  array (
    'controller_action' => 'Modules\\InventoryItemPrice\\Http\\Controllers\\InventoryItemPriceController@store',
    'permission' => 'inventory-item-price.inventory-item-price.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1466 => 
  array (
    'controller_action' => 'Modules\\InventoryItemPrice\\Http\\Controllers\\InventoryItemPriceController@update',
    'permission' => 'inventory-item-price.inventory-item-price.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1467 => 
  array (
    'controller_action' => 'Modules\\InventoryItemSerialNumber\\Http\\Controllers\\InventoryItemSerialNumberController@index',
    'permission' => 'inventory-item-serial-number.inventory-item-serial-number.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1468 => 
  array (
    'controller_action' => 'Modules\\InventoryItemSerialNumber\\Http\\Controllers\\InventoryItemSerialNumberController@show',
    'permission' => 'inventory-item-serial-number.inventory-item-serial-number.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1469 => 
  array (
    'controller_action' => 'Modules\\InventoryItemSerialNumber\\Http\\Controllers\\InventoryItemSerialNumberController@store',
    'permission' => 'inventory-item-serial-number.inventory-item-serial-number.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1470 => 
  array (
    'controller_action' => 'Modules\\InventoryItemSerialNumber\\Http\\Controllers\\InventoryItemSerialNumberController@update',
    'permission' => 'inventory-item-serial-number.inventory-item-serial-number.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1471 => 
  array (
    'controller_action' => 'Modules\\InventoryItemSerialNumber\\Http\\Controllers\\InventoryItemSerialNumberController@destroy',
    'permission' => 'inventory-item-serial-number.inventory-item-serial-number.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1472 => 
  array (
    'controller_action' => 'Modules\\InventoryLinenTracking\\Http\\Controllers\\LinenItemController@index',
    'permission' => 'inventory-linen-tracking.linen-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1473 => 
  array (
    'controller_action' => 'Modules\\InventoryLinenTracking\\Http\\Controllers\\LinenItemController@show',
    'permission' => 'inventory-linen-tracking.linen-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1474 => 
  array (
    'controller_action' => 'Modules\\InventoryLinenTracking\\Http\\Controllers\\LinenCycleController@index',
    'permission' => 'inventory-linen-tracking.linen-cycle.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1475 => 
  array (
    'controller_action' => 'Modules\\InventoryLinenTracking\\Http\\Controllers\\LinenCycleController@show',
    'permission' => 'inventory-linen-tracking.linen-cycle.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1476 => 
  array (
    'controller_action' => 'Modules\\InventoryLinenTracking\\Http\\Controllers\\LinenItemController@store',
    'permission' => 'inventory-linen-tracking.linen-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1477 => 
  array (
    'controller_action' => 'Modules\\InventoryLinenTracking\\Http\\Controllers\\LinenItemController@update',
    'permission' => 'inventory-linen-tracking.linen-item.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1478 => 
  array (
    'controller_action' => 'Modules\\InventoryLinenTracking\\Http\\Controllers\\LinenItemController@destroy',
    'permission' => 'inventory-linen-tracking.linen-item.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1479 => 
  array (
    'controller_action' => 'Modules\\InventoryLinenTracking\\Http\\Controllers\\LinenCycleController@store',
    'permission' => 'inventory-linen-tracking.linen-cycle.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1480 => 
  array (
    'controller_action' => 'Modules\\InventoryLinenTracking\\Http\\Controllers\\LinenCycleController@update',
    'permission' => 'inventory-linen-tracking.linen-cycle.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1481 => 
  array (
    'controller_action' => 'Modules\\InventoryLinenTracking\\Http\\Controllers\\LinenCycleController@destroy',
    'permission' => 'inventory-linen-tracking.linen-cycle.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1482 => 
  array (
    'controller_action' => 'Modules\\InventoryMinimumStockLevel\\Http\\Controllers\\InventoryMinimumStockLevelController@index',
    'permission' => 'inventory-minimum-stock-level.inventory-minimum-stock-level.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1483 => 
  array (
    'controller_action' => 'Modules\\InventoryMinimumStockLevel\\Http\\Controllers\\InventoryMinimumStockLevelController@show',
    'permission' => 'inventory-minimum-stock-level.inventory-minimum-stock-level.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1484 => 
  array (
    'controller_action' => 'Modules\\InventoryMinimumStockLevel\\Http\\Controllers\\InventoryMinimumStockLevelController@store',
    'permission' => 'inventory-minimum-stock-level.inventory-minimum-stock-level.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1485 => 
  array (
    'controller_action' => 'Modules\\InventoryMinimumStockLevel\\Http\\Controllers\\InventoryMinimumStockLevelController@update',
    'permission' => 'inventory-minimum-stock-level.inventory-minimum-stock-level.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1486 => 
  array (
    'controller_action' => 'Modules\\InventoryMinimumStockLevel\\Http\\Controllers\\InventoryMinimumStockLevelController@destroy',
    'permission' => 'inventory-minimum-stock-level.inventory-minimum-stock-level.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1487 => 
  array (
    'controller_action' => 'Modules\\InventoryPharmacyPackage\\Http\\Controllers\\InventoryPharmacyPackageController@index',
    'permission' => 'inventory-pharmacy-package.inventory-pharmacy-package.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1488 => 
  array (
    'controller_action' => 'Modules\\InventoryPharmacyPackage\\Http\\Controllers\\InventoryPharmacyPackageController@show',
    'permission' => 'inventory-pharmacy-package.inventory-pharmacy-package.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1489 => 
  array (
    'controller_action' => 'Modules\\InventoryPharmacyPackage\\Http\\Controllers\\InventoryPharmacyPackageController@store',
    'permission' => 'inventory-pharmacy-package.inventory-pharmacy-package.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1490 => 
  array (
    'controller_action' => 'Modules\\InventoryPharmacyPackage\\Http\\Controllers\\InventoryPharmacyPackageController@update',
    'permission' => 'inventory-pharmacy-package.inventory-pharmacy-package.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1491 => 
  array (
    'controller_action' => 'Modules\\InventoryPharmacyPackage\\Http\\Controllers\\InventoryPharmacyPackageController@destroy',
    'permission' => 'inventory-pharmacy-package.inventory-pharmacy-package.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1492 => 
  array (
    'controller_action' => 'Modules\\InventoryReceivingItem\\Http\\Controllers\\ReceivingItemController@index',
    'permission' => 'inventory-receiving-item.receiving-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1493 => 
  array (
    'controller_action' => 'Modules\\InventoryReceivingItem\\Http\\Controllers\\ReceivingItemController@show',
    'permission' => 'inventory-receiving-item.receiving-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1494 => 
  array (
    'controller_action' => 'Modules\\InventoryReceivingItem\\Http\\Controllers\\ReceivingItemController@store',
    'permission' => 'inventory-receiving-item.receiving-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1495 => 
  array (
    'controller_action' => 'Modules\\InventoryReceivingRecord\\Http\\Controllers\\ReceivingRecordController@index',
    'permission' => 'inventory-receiving-record.receiving-record.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1496 => 
  array (
    'controller_action' => 'Modules\\InventoryReceivingRecord\\Http\\Controllers\\ReceivingRecordController@show',
    'permission' => 'inventory-receiving-record.receiving-record.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1497 => 
  array (
    'controller_action' => 'Modules\\InventoryReceivingRecord\\Http\\Controllers\\ReceivingRecordController@store',
    'permission' => 'inventory-receiving-record.receiving-record.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1498 => 
  array (
    'controller_action' => 'Modules\\InventoryShipment\\Http\\Controllers\\ShipmentController@index',
    'permission' => 'inventory-shipment.shipment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1499 => 
  array (
    'controller_action' => 'Modules\\InventoryShipment\\Http\\Controllers\\ShipmentController@show',
    'permission' => 'inventory-shipment.shipment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1500 => 
  array (
    'controller_action' => 'Modules\\InventoryShipment\\Http\\Controllers\\ShipmentController@store',
    'permission' => 'inventory-shipment.shipment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1501 => 
  array (
    'controller_action' => 'Modules\\InventoryShipment\\Http\\Controllers\\ShipmentController@update',
    'permission' => 'inventory-shipment.shipment.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1502 => 
  array (
    'controller_action' => 'Modules\\InventoryShipmentItem\\Http\\Controllers\\ShipmentItemController@index',
    'permission' => 'inventory-shipment-item.shipment-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1503 => 
  array (
    'controller_action' => 'Modules\\InventoryShipmentItem\\Http\\Controllers\\ShipmentItemController@show',
    'permission' => 'inventory-shipment-item.shipment-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1504 => 
  array (
    'controller_action' => 'Modules\\InventoryShipmentItem\\Http\\Controllers\\ShipmentItemController@store',
    'permission' => 'inventory-shipment-item.shipment-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1505 => 
  array (
    'controller_action' => 'Modules\\InventorySterilizationCycle\\Http\\Controllers\\SterilizationCycleController@index',
    'permission' => 'inventory-sterilization-cycle.sterilization-cycle.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1506 => 
  array (
    'controller_action' => 'Modules\\InventorySterilizationCycle\\Http\\Controllers\\SterilizationCycleController@show',
    'permission' => 'inventory-sterilization-cycle.sterilization-cycle.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1507 => 
  array (
    'controller_action' => 'Modules\\InventorySterilizationCycle\\Http\\Controllers\\SterilizedItemController@index',
    'permission' => 'inventory-sterilization-cycle.sterilized-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1508 => 
  array (
    'controller_action' => 'Modules\\InventorySterilizationCycle\\Http\\Controllers\\SterilizedItemController@show',
    'permission' => 'inventory-sterilization-cycle.sterilized-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1509 => 
  array (
    'controller_action' => 'Modules\\InventorySterilizationCycle\\Http\\Controllers\\SterilizedItemController@checkExpiry',
    'permission' => 'inventory-sterilization-cycle.sterilized-item.check-expiry',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1510 => 
  array (
    'controller_action' => 'Modules\\InventorySterilizationCycle\\Http\\Controllers\\SterilizationCycleController@store',
    'permission' => 'inventory-sterilization-cycle.sterilization-cycle.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1511 => 
  array (
    'controller_action' => 'Modules\\InventorySterilizationCycle\\Http\\Controllers\\SterilizationCycleController@update',
    'permission' => 'inventory-sterilization-cycle.sterilization-cycle.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1512 => 
  array (
    'controller_action' => 'Modules\\InventorySterilizationCycle\\Http\\Controllers\\SterilizationCycleController@destroy',
    'permission' => 'inventory-sterilization-cycle.sterilization-cycle.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1513 => 
  array (
    'controller_action' => 'Modules\\InventorySterilizationCycle\\Http\\Controllers\\SterilizedItemController@store',
    'permission' => 'inventory-sterilization-cycle.sterilized-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1514 => 
  array (
    'controller_action' => 'Modules\\InventorySterilizationCycle\\Http\\Controllers\\SterilizedItemController@update',
    'permission' => 'inventory-sterilization-cycle.sterilized-item.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1515 => 
  array (
    'controller_action' => 'Modules\\InventorySterilizationCycle\\Http\\Controllers\\SterilizedItemController@destroy',
    'permission' => 'inventory-sterilization-cycle.sterilized-item.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1516 => 
  array (
    'controller_action' => 'Modules\\InventoryStockOpname\\Http\\Controllers\\InventoryStockOpnameController@index',
    'permission' => 'inventory-stock-opname.inventory-stock-opname.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1517 => 
  array (
    'controller_action' => 'Modules\\InventoryStockOpname\\Http\\Controllers\\InventoryStockOpnameController@show',
    'permission' => 'inventory-stock-opname.inventory-stock-opname.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1518 => 
  array (
    'controller_action' => 'Modules\\InventoryStockOpname\\Http\\Controllers\\InventoryStockOpnameController@store',
    'permission' => 'inventory-stock-opname.inventory-stock-opname.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1519 => 
  array (
    'controller_action' => 'Modules\\InventoryStockOpname\\Http\\Controllers\\InventoryStockOpnameController@update',
    'permission' => 'inventory-stock-opname.inventory-stock-opname.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1520 => 
  array (
    'controller_action' => 'Modules\\InventoryStockOpnameItem\\Http\\Controllers\\InventoryStockOpnameItemController@index',
    'permission' => 'inventory-stock-opname-item.inventory-stock-opname-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1521 => 
  array (
    'controller_action' => 'Modules\\InventoryStockOpnameItem\\Http\\Controllers\\InventoryStockOpnameItemController@show',
    'permission' => 'inventory-stock-opname-item.inventory-stock-opname-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1522 => 
  array (
    'controller_action' => 'Modules\\InventoryStockOpnameItem\\Http\\Controllers\\InventoryStockOpnameItemController@store',
    'permission' => 'inventory-stock-opname-item.inventory-stock-opname-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1523 => 
  array (
    'controller_action' => 'Modules\\InventoryStockRequest\\Http\\Controllers\\StockRequestController@index',
    'permission' => 'inventory-stock-request.stock-request.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1524 => 
  array (
    'controller_action' => 'Modules\\InventoryStockRequest\\Http\\Controllers\\StockRequestController@show',
    'permission' => 'inventory-stock-request.stock-request.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1525 => 
  array (
    'controller_action' => 'Modules\\InventoryStockRequest\\Http\\Controllers\\StockRequestController@store',
    'permission' => 'inventory-stock-request.stock-request.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1526 => 
  array (
    'controller_action' => 'Modules\\InventoryStockRequest\\Http\\Controllers\\StockRequestController@update',
    'permission' => 'inventory-stock-request.stock-request.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1527 => 
  array (
    'controller_action' => 'Modules\\InventoryStockRequestItem\\Http\\Controllers\\InventoryStockRequestItemController@index',
    'permission' => 'inventory-stock-request-item.inventory-stock-request-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1528 => 
  array (
    'controller_action' => 'Modules\\InventoryStockRequestItem\\Http\\Controllers\\InventoryStockRequestItemController@show',
    'permission' => 'inventory-stock-request-item.inventory-stock-request-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1529 => 
  array (
    'controller_action' => 'Modules\\InventoryStockRequestItem\\Http\\Controllers\\InventoryStockRequestItemController@store',
    'permission' => 'inventory-stock-request-item.inventory-stock-request-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1530 => 
  array (
    'controller_action' => 'Modules\\InventorySupplier\\Http\\Controllers\\SupplierController@index',
    'permission' => 'inventory-supplier.supplier.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1531 => 
  array (
    'controller_action' => 'Modules\\InventorySupplier\\Http\\Controllers\\SupplierController@show',
    'permission' => 'inventory-supplier.supplier.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1532 => 
  array (
    'controller_action' => 'Modules\\InventorySupplier\\Http\\Controllers\\SupplierController@store',
    'permission' => 'inventory-supplier.supplier.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1533 => 
  array (
    'controller_action' => 'Modules\\InventorySupplier\\Http\\Controllers\\SupplierController@update',
    'permission' => 'inventory-supplier.supplier.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1534 => 
  array (
    'controller_action' => 'Modules\\InventorySupplier\\Http\\Controllers\\SupplierController@destroy',
    'permission' => 'inventory-supplier.supplier.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1535 => 
  array (
    'controller_action' => 'Modules\\InventoryUnitOfMeasure\\Http\\Controllers\\InventoryUnitOfMeasureController@index',
    'permission' => 'inventory-unit-of-measure.inventory-unit-of-measure.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1536 => 
  array (
    'controller_action' => 'Modules\\InventoryUnitOfMeasure\\Http\\Controllers\\InventoryUnitOfMeasureController@show',
    'permission' => 'inventory-unit-of-measure.inventory-unit-of-measure.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1537 => 
  array (
    'controller_action' => 'Modules\\InventoryUnitOfMeasure\\Http\\Controllers\\InventoryUnitOfMeasureController@store',
    'permission' => 'inventory-unit-of-measure.inventory-unit-of-measure.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1538 => 
  array (
    'controller_action' => 'Modules\\InventoryUnitOfMeasure\\Http\\Controllers\\InventoryUnitOfMeasureController@update',
    'permission' => 'inventory-unit-of-measure.inventory-unit-of-measure.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1539 => 
  array (
    'controller_action' => 'Modules\\InventoryUnitOfMeasure\\Http\\Controllers\\InventoryUnitOfMeasureController@destroy',
    'permission' => 'inventory-unit-of-measure.inventory-unit-of-measure.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1540 => 
  array (
    'controller_action' => 'Modules\\InventoryWardItemStock\\Http\\Controllers\\InventoryWardItemStockController@index',
    'permission' => 'inventory-ward-item-stock.inventory-ward-item-stock.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1541 => 
  array (
    'controller_action' => 'Modules\\InventoryWardItemStock\\Http\\Controllers\\InventoryWardItemStockController@store',
    'permission' => 'inventory-ward-item-stock.inventory-ward-item-stock.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1542 => 
  array (
    'controller_action' => 'Modules\\InventoryWardItemStock\\Http\\Controllers\\InventoryWardItemStockController@show',
    'permission' => 'inventory-ward-item-stock.inventory-ward-item-stock.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1543 => 
  array (
    'controller_action' => 'Modules\\InventoryWardItemStock\\Http\\Controllers\\InventoryWardItemStockController@update',
    'permission' => 'inventory-ward-item-stock.inventory-ward-item-stock.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1544 => 
  array (
    'controller_action' => 'Modules\\InventoryWardItemStock\\Http\\Controllers\\InventoryWardItemStockController@destroy',
    'permission' => 'inventory-ward-item-stock.inventory-ward-item-stock.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1545 => 
  array (
    'controller_action' => 'Modules\\InventoryWardStockTransaction\\Http\\Controllers\\InventoryWardStockTransactionController@index',
    'permission' => 'inventory-ward-stock-transaction.inventory-ward-stock-transaction.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1546 => 
  array (
    'controller_action' => 'Modules\\InventoryWardStockTransaction\\Http\\Controllers\\InventoryWardStockTransactionController@show',
    'permission' => 'inventory-ward-stock-transaction.inventory-ward-stock-transaction.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1547 => 
  array (
    'controller_action' => 'Modules\\InventoryWardStockTransaction\\Http\\Controllers\\InventoryWardStockTransactionController@store',
    'permission' => 'inventory-ward-stock-transaction.inventory-ward-stock-transaction.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1548 => 
  array (
    'controller_action' => 'Modules\\KemkesBloodType\\Http\\Controllers\\BloodTypeController@index',
    'permission' => 'kemkes-blood-type.blood-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1549 => 
  array (
    'controller_action' => 'Modules\\KemkesBloodType\\Http\\Controllers\\BloodTypeController@show',
    'permission' => 'kemkes-blood-type.blood-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1550 => 
  array (
    'controller_action' => 'Modules\\KemkesBloodType\\Http\\Controllers\\BloodTypeController@store',
    'permission' => 'kemkes-blood-type.blood-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1551 => 
  array (
    'controller_action' => 'Modules\\KemkesBloodType\\Http\\Controllers\\BloodTypeController@update',
    'permission' => 'kemkes-blood-type.blood-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1552 => 
  array (
    'controller_action' => 'Modules\\KemkesBloodType\\Http\\Controllers\\BloodTypeController@destroy',
    'permission' => 'kemkes-blood-type.blood-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1553 => 
  array (
    'controller_action' => 'Modules\\KemkesReport\\Http\\Controllers\\KemkesReportController@bedOccupancy',
    'permission' => 'kemkes-report.kemkes-report.bed-occupancy',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1554 => 
  array (
    'controller_action' => 'Modules\\KemkesReport\\Http\\Controllers\\KemkesReportController@inpatientIndicators',
    'permission' => 'kemkes-report.kemkes-report.inpatient-indicators',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1555 => 
  array (
    'controller_action' => 'Modules\\KemkesReport\\Http\\Controllers\\KemkesReportController@inpatientVisitsByClass',
    'permission' => 'kemkes-report.kemkes-report.inpatient-visits-by-class',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1556 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipApproval\\Http\\Controllers\\AntimicrobialStewardshipApprovalController@index',
    'permission' => 'layanan-antimicrobial-stewardship-approval.antimicrobial-stewardship-approval.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1557 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipApproval\\Http\\Controllers\\AntimicrobialStewardshipApprovalController@show',
    'permission' => 'layanan-antimicrobial-stewardship-approval.antimicrobial-stewardship-approval.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1558 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipApproval\\Http\\Controllers\\AntimicrobialStewardshipApprovalController@store',
    'permission' => 'layanan-antimicrobial-stewardship-approval.antimicrobial-stewardship-approval.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1559 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipForm\\Http\\Controllers\\AntimicrobialStewardshipFormController@index',
    'permission' => 'layanan-antimicrobial-stewardship-form.antimicrobial-stewardship-form.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1560 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipForm\\Http\\Controllers\\AntimicrobialStewardshipFormController@show',
    'permission' => 'layanan-antimicrobial-stewardship-form.antimicrobial-stewardship-form.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1561 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipForm\\Http\\Controllers\\AntimicrobialStewardshipFormController@store',
    'permission' => 'layanan-antimicrobial-stewardship-form.antimicrobial-stewardship-form.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1562 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipForm\\Http\\Controllers\\AntimicrobialStewardshipFormController@update',
    'permission' => 'layanan-antimicrobial-stewardship-form.antimicrobial-stewardship-form.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1563 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipFormItem\\Http\\Controllers\\AntimicrobialStewardshipFormItemController@index',
    'permission' => 'layanan-antimicrobial-stewardship-form-item.antimicrobial-stewardship-form-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1564 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipFormItem\\Http\\Controllers\\AntimicrobialStewardshipFormItemController@show',
    'permission' => 'layanan-antimicrobial-stewardship-form-item.antimicrobial-stewardship-form-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1565 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipFormItem\\Http\\Controllers\\AntimicrobialStewardshipFormItemController@store',
    'permission' => 'layanan-antimicrobial-stewardship-form-item.antimicrobial-stewardship-form-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1566 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipGeneralExamination\\Http\\Controllers\\AntimicrobialStewardshipGeneralExaminationController@index',
    'permission' => 'layanan-antimicrobial-stewardship-general-examination.antimicrobial-stewardship-general-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1567 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipGeneralExamination\\Http\\Controllers\\AntimicrobialStewardshipGeneralExaminationController@show',
    'permission' => 'layanan-antimicrobial-stewardship-general-examination.antimicrobial-stewardship-general-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1568 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipGeneralExamination\\Http\\Controllers\\AntimicrobialStewardshipGeneralExaminationController@store',
    'permission' => 'layanan-antimicrobial-stewardship-general-examination.antimicrobial-stewardship-general-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1569 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipLabResult\\Http\\Controllers\\AntimicrobialStewardshipLabResultController@index',
    'permission' => 'layanan-antimicrobial-stewardship-lab-result.antimicrobial-stewardship-lab-result.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1570 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipLabResult\\Http\\Controllers\\AntimicrobialStewardshipLabResultController@show',
    'permission' => 'layanan-antimicrobial-stewardship-lab-result.antimicrobial-stewardship-lab-result.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1571 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipLabResult\\Http\\Controllers\\AntimicrobialStewardshipLabResultController@store',
    'permission' => 'layanan-antimicrobial-stewardship-lab-result.antimicrobial-stewardship-lab-result.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1572 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipMicrobiologyResult\\Http\\Controllers\\AntimicrobialStewardshipMicrobiologyResultController@index',
    'permission' => 'layanan-antimicrobial-stewardship-microbiology-result.antimicrobial-stewardship-microbiology-result.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1573 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipMicrobiologyResult\\Http\\Controllers\\AntimicrobialStewardshipMicrobiologyResultController@show',
    'permission' => 'layanan-antimicrobial-stewardship-microbiology-result.antimicrobial-stewardship-microbiology-result.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1574 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipMicrobiologyResult\\Http\\Controllers\\AntimicrobialStewardshipMicrobiologyResultController@store',
    'permission' => 'layanan-antimicrobial-stewardship-microbiology-result.antimicrobial-stewardship-microbiology-result.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1575 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipOtherSupportResult\\Http\\Controllers\\AntimicrobialStewardshipOtherSupportResultController@index',
    'permission' => 'layanan-antimicrobial-stewardship-other-support-result.antimicrobial-stewardship-other-support-result.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1576 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipOtherSupportResult\\Http\\Controllers\\AntimicrobialStewardshipOtherSupportResultController@show',
    'permission' => 'layanan-antimicrobial-stewardship-other-support-result.antimicrobial-stewardship-other-support-result.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1577 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipOtherSupportResult\\Http\\Controllers\\AntimicrobialStewardshipOtherSupportResultController@store',
    'permission' => 'layanan-antimicrobial-stewardship-other-support-result.antimicrobial-stewardship-other-support-result.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1578 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipPriorHistory\\Http\\Controllers\\AntimicrobialStewardshipPriorHistoryController@index',
    'permission' => 'layanan-antimicrobial-stewardship-prior-history.antimicrobial-stewardship-prior-history.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1579 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipPriorHistory\\Http\\Controllers\\AntimicrobialStewardshipPriorHistoryController@show',
    'permission' => 'layanan-antimicrobial-stewardship-prior-history.antimicrobial-stewardship-prior-history.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1580 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipPriorHistory\\Http\\Controllers\\AntimicrobialStewardshipPriorHistoryController@store',
    'permission' => 'layanan-antimicrobial-stewardship-prior-history.antimicrobial-stewardship-prior-history.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1581 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipRadiologyResult\\Http\\Controllers\\AntimicrobialStewardshipRadiologyResultController@index',
    'permission' => 'layanan-antimicrobial-stewardship-radiology-result.antimicrobial-stewardship-radiology-result.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1582 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipRadiologyResult\\Http\\Controllers\\AntimicrobialStewardshipRadiologyResultController@show',
    'permission' => 'layanan-antimicrobial-stewardship-radiology-result.antimicrobial-stewardship-radiology-result.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1583 => 
  array (
    'controller_action' => 'Modules\\LayananAntimicrobialStewardshipRadiologyResult\\Http\\Controllers\\AntimicrobialStewardshipRadiologyResultController@store',
    'permission' => 'layanan-antimicrobial-stewardship-radiology-result.antimicrobial-stewardship-radiology-result.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1584 => 
  array (
    'controller_action' => 'Modules\\LayananBirthRecord\\Http\\Controllers\\BirthRecordController@index',
    'permission' => 'layanan-birth-record.birth-record.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1585 => 
  array (
    'controller_action' => 'Modules\\LayananBirthRecord\\Http\\Controllers\\BirthRecordController@show',
    'permission' => 'layanan-birth-record.birth-record.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1586 => 
  array (
    'controller_action' => 'Modules\\LayananBirthRecord\\Http\\Controllers\\BirthRecordController@store',
    'permission' => 'layanan-birth-record.birth-record.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1587 => 
  array (
    'controller_action' => 'Modules\\LayananBirthRecord\\Http\\Controllers\\BirthRecordController@update',
    'permission' => 'layanan-birth-record.birth-record.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1588 => 
  array (
    'controller_action' => 'Modules\\LayananBloodRequestItem\\Http\\Controllers\\BloodRequestItemController@index',
    'permission' => 'layanan-blood-request-item.blood-request-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1589 => 
  array (
    'controller_action' => 'Modules\\LayananBloodRequestItem\\Http\\Controllers\\BloodRequestItemController@show',
    'permission' => 'layanan-blood-request-item.blood-request-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1590 => 
  array (
    'controller_action' => 'Modules\\LayananBloodRequestItem\\Http\\Controllers\\BloodRequestItemController@store',
    'permission' => 'layanan-blood-request-item.blood-request-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1591 => 
  array (
    'controller_action' => 'Modules\\LayananBloodRequestItem\\Http\\Controllers\\BloodRequestItemController@update',
    'permission' => 'layanan-blood-request-item.blood-request-item.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1592 => 
  array (
    'controller_action' => 'Modules\\LayananBloodRequestItem\\Http\\Controllers\\BloodRequestItemController@destroy',
    'permission' => 'layanan-blood-request-item.blood-request-item.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1593 => 
  array (
    'controller_action' => 'Modules\\LayananCriticalLabValue\\Http\\Controllers\\CriticalLabValueController@index',
    'permission' => 'layanan-critical-lab-value.critical-lab-value.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1594 => 
  array (
    'controller_action' => 'Modules\\LayananCriticalLabValue\\Http\\Controllers\\CriticalLabValueController@show',
    'permission' => 'layanan-critical-lab-value.critical-lab-value.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1595 => 
  array (
    'controller_action' => 'Modules\\LayananCriticalLabValue\\Http\\Controllers\\CriticalLabValueController@store',
    'permission' => 'layanan-critical-lab-value.critical-lab-value.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1596 => 
  array (
    'controller_action' => 'Modules\\LayananCriticalLabValue\\Http\\Controllers\\CriticalLabValueController@update',
    'permission' => 'layanan-critical-lab-value.critical-lab-value.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1597 => 
  array (
    'controller_action' => 'Modules\\LayananCriticalLabValue\\Http\\Controllers\\CriticalLabValueController@notify',
    'permission' => 'layanan-critical-lab-value.critical-lab-value.notify',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1598 => 
  array (
    'controller_action' => 'Modules\\LayananCriticalLabValue\\Http\\Controllers\\CriticalLabValueController@acknowledge',
    'permission' => 'layanan-critical-lab-value.critical-lab-value.acknowledge',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1599 => 
  array (
    'controller_action' => 'Modules\\LayananDrugInteractionCheck\\Http\\Controllers\\DrugInteractionRuleController@index',
    'permission' => 'layanan-drug-interaction-check.drug-interaction-rule.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1600 => 
  array (
    'controller_action' => 'Modules\\LayananDrugInteractionCheck\\Http\\Controllers\\DrugInteractionRuleController@show',
    'permission' => 'layanan-drug-interaction-check.drug-interaction-rule.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1601 => 
  array (
    'controller_action' => 'Modules\\LayananDrugInteractionCheck\\Http\\Controllers\\DrugInteractionRuleController@store',
    'permission' => 'layanan-drug-interaction-check.drug-interaction-rule.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1602 => 
  array (
    'controller_action' => 'Modules\\LayananDrugInteractionCheck\\Http\\Controllers\\DrugInteractionRuleController@update',
    'permission' => 'layanan-drug-interaction-check.drug-interaction-rule.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1603 => 
  array (
    'controller_action' => 'Modules\\LayananDrugInteractionCheck\\Http\\Controllers\\DrugInteractionRuleController@destroy',
    'permission' => 'layanan-drug-interaction-check.drug-interaction-rule.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1604 => 
  array (
    'controller_action' => 'Modules\\LayananDrugInteractionCheck\\Http\\Controllers\\DrugInteractionCheckController',
    'permission' => 'layanan-drug-interaction-check.drug-interaction-check.invoke',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1605 => 
  array (
    'controller_action' => 'Modules\\LayananEarlyWarningScore\\Http\\Controllers\\VitalSignObservationController@index',
    'permission' => 'layanan-early-warning-score.vital-sign-observation.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1606 => 
  array (
    'controller_action' => 'Modules\\LayananEarlyWarningScore\\Http\\Controllers\\VitalSignObservationController@show',
    'permission' => 'layanan-early-warning-score.vital-sign-observation.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1607 => 
  array (
    'controller_action' => 'Modules\\LayananEarlyWarningScore\\Http\\Controllers\\VitalSignObservationController@store',
    'permission' => 'layanan-early-warning-score.vital-sign-observation.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1608 => 
  array (
    'controller_action' => 'Modules\\LayananExaminationResultStatus\\Http\\Controllers\\ExaminationResultStatusController@index',
    'permission' => 'layanan-examination-result-status.examination-result-status.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1609 => 
  array (
    'controller_action' => 'Modules\\LayananExaminationResultStatus\\Http\\Controllers\\ExaminationResultStatusController@show',
    'permission' => 'layanan-examination-result-status.examination-result-status.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1610 => 
  array (
    'controller_action' => 'Modules\\LayananExaminationResultStatus\\Http\\Controllers\\ExaminationResultStatusController@store',
    'permission' => 'layanan-examination-result-status.examination-result-status.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1611 => 
  array (
    'controller_action' => 'Modules\\LayananExaminationResultStatus\\Http\\Controllers\\ExaminationResultStatusController@update',
    'permission' => 'layanan-examination-result-status.examination-result-status.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1612 => 
  array (
    'controller_action' => 'Modules\\LayananExaminationResultStatus\\Http\\Controllers\\ExaminationResultStatusController@destroy',
    'permission' => 'layanan-examination-result-status.examination-result-status.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1613 => 
  array (
    'controller_action' => 'Modules\\LayananLabAnalyzerOrder\\Http\\Controllers\\LabAnalyzerVendorController@index',
    'permission' => 'layanan-lab-analyzer-order.lab-analyzer-vendor.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1614 => 
  array (
    'controller_action' => 'Modules\\LayananLabAnalyzerOrder\\Http\\Controllers\\LabAnalyzerVendorController@show',
    'permission' => 'layanan-lab-analyzer-order.lab-analyzer-vendor.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1615 => 
  array (
    'controller_action' => 'Modules\\LayananLabAnalyzerOrder\\Http\\Controllers\\LabAnalyzerOrderController@index',
    'permission' => 'layanan-lab-analyzer-order.lab-analyzer-order.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1616 => 
  array (
    'controller_action' => 'Modules\\LayananLabAnalyzerOrder\\Http\\Controllers\\LabAnalyzerOrderController@show',
    'permission' => 'layanan-lab-analyzer-order.lab-analyzer-order.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1617 => 
  array (
    'controller_action' => 'Modules\\LayananLabAnalyzerOrder\\Http\\Controllers\\LabAnalyzerVendorController@store',
    'permission' => 'layanan-lab-analyzer-order.lab-analyzer-vendor.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1618 => 
  array (
    'controller_action' => 'Modules\\LayananLabAnalyzerOrder\\Http\\Controllers\\LabAnalyzerVendorController@update',
    'permission' => 'layanan-lab-analyzer-order.lab-analyzer-vendor.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1619 => 
  array (
    'controller_action' => 'Modules\\LayananLabAnalyzerOrder\\Http\\Controllers\\LabAnalyzerVendorController@destroy',
    'permission' => 'layanan-lab-analyzer-order.lab-analyzer-vendor.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1620 => 
  array (
    'controller_action' => 'Modules\\LayananLabAnalyzerOrder\\Http\\Controllers\\LabAnalyzerOrderController@store',
    'permission' => 'layanan-lab-analyzer-order.lab-analyzer-order.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1621 => 
  array (
    'controller_action' => 'Modules\\LayananLabAnalyzerOrder\\Http\\Controllers\\LabAnalyzerOrderController@update',
    'permission' => 'layanan-lab-analyzer-order.lab-analyzer-order.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1622 => 
  array (
    'controller_action' => 'Modules\\LayananLabAnalyzerOrder\\Http\\Controllers\\LabAnalyzerOrderController@destroy',
    'permission' => 'layanan-lab-analyzer-order.lab-analyzer-order.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1623 => 
  array (
    'controller_action' => 'Modules\\LayananLabAnalyzerOrder\\Http\\Controllers\\LabAnalyzerOrderController@sendToAnalyzer',
    'permission' => 'layanan-lab-analyzer-order.lab-analyzer-order.send-to-analyzer',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1624 => 
  array (
    'controller_action' => 'Modules\\LayananLabAnalyzerOrder\\Http\\Controllers\\LabAnalyzerOrderController@recordResult',
    'permission' => 'layanan-lab-analyzer-order.lab-analyzer-order.record-result',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1625 => 
  array (
    'controller_action' => 'Modules\\LayananLabAnalyzerOrder\\Http\\Controllers\\LabAnalyzerOrderController@verify',
    'permission' => 'layanan-lab-analyzer-order.lab-analyzer-order.verify',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1626 => 
  array (
    'controller_action' => 'Modules\\LayananLabCultureResult\\Http\\Controllers\\LabCultureResultController@index',
    'permission' => 'layanan-lab-culture-result.lab-culture-result.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1627 => 
  array (
    'controller_action' => 'Modules\\LayananLabCultureResult\\Http\\Controllers\\LabCultureResultController@show',
    'permission' => 'layanan-lab-culture-result.lab-culture-result.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1628 => 
  array (
    'controller_action' => 'Modules\\LayananLabCultureResult\\Http\\Controllers\\LabCultureResultController@store',
    'permission' => 'layanan-lab-culture-result.lab-culture-result.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1629 => 
  array (
    'controller_action' => 'Modules\\LayananLabCultureResult\\Http\\Controllers\\LabCultureResultController@update',
    'permission' => 'layanan-lab-culture-result.lab-culture-result.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1630 => 
  array (
    'controller_action' => 'Modules\\LayananLabExaminationResult\\Http\\Controllers\\LabExaminationResultController@index',
    'permission' => 'layanan-lab-examination-result.lab-examination-result.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1631 => 
  array (
    'controller_action' => 'Modules\\LayananLabExaminationResult\\Http\\Controllers\\LabExaminationResultController@show',
    'permission' => 'layanan-lab-examination-result.lab-examination-result.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1632 => 
  array (
    'controller_action' => 'Modules\\LayananLabExaminationResult\\Http\\Controllers\\LabExaminationResultController@store',
    'permission' => 'layanan-lab-examination-result.lab-examination-result.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1633 => 
  array (
    'controller_action' => 'Modules\\LayananLabMicroscopicResult\\Http\\Controllers\\LabMicroscopicResultController@index',
    'permission' => 'layanan-lab-microscopic-result.lab-microscopic-result.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1634 => 
  array (
    'controller_action' => 'Modules\\LayananLabMicroscopicResult\\Http\\Controllers\\LabMicroscopicResultController@show',
    'permission' => 'layanan-lab-microscopic-result.lab-microscopic-result.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1635 => 
  array (
    'controller_action' => 'Modules\\LayananLabMicroscopicResult\\Http\\Controllers\\LabMicroscopicResultController@store',
    'permission' => 'layanan-lab-microscopic-result.lab-microscopic-result.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1636 => 
  array (
    'controller_action' => 'Modules\\LayananLabMicroscopicResultItem\\Http\\Controllers\\LabMicroscopicResultItemController@index',
    'permission' => 'layanan-lab-microscopic-result-item.lab-microscopic-result-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1637 => 
  array (
    'controller_action' => 'Modules\\LayananLabMicroscopicResultItem\\Http\\Controllers\\LabMicroscopicResultItemController@show',
    'permission' => 'layanan-lab-microscopic-result-item.lab-microscopic-result-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1638 => 
  array (
    'controller_action' => 'Modules\\LayananLabMicroscopicResultItem\\Http\\Controllers\\LabMicroscopicResultItemController@store',
    'permission' => 'layanan-lab-microscopic-result-item.lab-microscopic-result-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1639 => 
  array (
    'controller_action' => 'Modules\\LayananLabOrder\\Http\\Controllers\\LabOrderController@index',
    'permission' => 'layanan-lab-order.lab-order.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1640 => 
  array (
    'controller_action' => 'Modules\\LayananLabOrder\\Http\\Controllers\\LabOrderController@show',
    'permission' => 'layanan-lab-order.lab-order.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1641 => 
  array (
    'controller_action' => 'Modules\\LayananLabOrder\\Http\\Controllers\\LabOrderController@store',
    'permission' => 'layanan-lab-order.lab-order.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1642 => 
  array (
    'controller_action' => 'Modules\\LayananLabOrder\\Http\\Controllers\\LabOrderController@update',
    'permission' => 'layanan-lab-order.lab-order.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1643 => 
  array (
    'controller_action' => 'Modules\\LayananLabOrderItem\\Http\\Controllers\\LabOrderItemController@index',
    'permission' => 'layanan-lab-order-item.lab-order-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1644 => 
  array (
    'controller_action' => 'Modules\\LayananLabOrderItem\\Http\\Controllers\\LabOrderItemController@show',
    'permission' => 'layanan-lab-order-item.lab-order-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1645 => 
  array (
    'controller_action' => 'Modules\\LayananLabOrderItem\\Http\\Controllers\\LabOrderItemController@store',
    'permission' => 'layanan-lab-order-item.lab-order-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1646 => 
  array (
    'controller_action' => 'Modules\\LayananLabPcrResult\\Http\\Controllers\\LabPcrResultController@index',
    'permission' => 'layanan-lab-pcr-result.lab-pcr-result.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1647 => 
  array (
    'controller_action' => 'Modules\\LayananLabPcrResult\\Http\\Controllers\\LabPcrResultController@show',
    'permission' => 'layanan-lab-pcr-result.lab-pcr-result.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1648 => 
  array (
    'controller_action' => 'Modules\\LayananLabPcrResult\\Http\\Controllers\\LabPcrResultController@store',
    'permission' => 'layanan-lab-pcr-result.lab-pcr-result.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1649 => 
  array (
    'controller_action' => 'Modules\\LayananLabResult\\Http\\Controllers\\LabResultController@transition',
    'permission' => 'layanan-lab-result.lab-result.transition',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1650 => 
  array (
    'controller_action' => 'Modules\\LayananLabResult\\Http\\Controllers\\LabResultController@index',
    'permission' => 'layanan-lab-result.lab-result.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1651 => 
  array (
    'controller_action' => 'Modules\\LayananLabResult\\Http\\Controllers\\LabResultController@show',
    'permission' => 'layanan-lab-result.lab-result.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1652 => 
  array (
    'controller_action' => 'Modules\\LayananLabResult\\Http\\Controllers\\LabResultController@store',
    'permission' => 'layanan-lab-result.lab-result.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1653 => 
  array (
    'controller_action' => 'Modules\\LayananLabResultNote\\Http\\Controllers\\LabResultNoteController@index',
    'permission' => 'layanan-lab-result-note.lab-result-note.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1654 => 
  array (
    'controller_action' => 'Modules\\LayananLabResultNote\\Http\\Controllers\\LabResultNoteController@show',
    'permission' => 'layanan-lab-result-note.lab-result-note.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1655 => 
  array (
    'controller_action' => 'Modules\\LayananLabResultNote\\Http\\Controllers\\LabResultNoteController@store',
    'permission' => 'layanan-lab-result-note.lab-result-note.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1656 => 
  array (
    'controller_action' => 'Modules\\LayananLabResultNote\\Http\\Controllers\\LabResultNoteController@update',
    'permission' => 'layanan-lab-result-note.lab-result-note.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1657 => 
  array (
    'controller_action' => 'Modules\\LayananLabResultNote\\Http\\Controllers\\LabResultNoteController@destroy',
    'permission' => 'layanan-lab-result-note.lab-result-note.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1658 => 
  array (
    'controller_action' => 'Modules\\LayananLabSensitivityResult\\Http\\Controllers\\LabSensitivityResultController@index',
    'permission' => 'layanan-lab-sensitivity-result.lab-sensitivity-result.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1659 => 
  array (
    'controller_action' => 'Modules\\LayananLabSensitivityResult\\Http\\Controllers\\LabSensitivityResultController@show',
    'permission' => 'layanan-lab-sensitivity-result.lab-sensitivity-result.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1660 => 
  array (
    'controller_action' => 'Modules\\LayananLabSensitivityResult\\Http\\Controllers\\LabSensitivityResultController@store',
    'permission' => 'layanan-lab-sensitivity-result.lab-sensitivity-result.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1661 => 
  array (
    'controller_action' => 'Modules\\LayananLeftoverMedicationVoucher\\Http\\Controllers\\LeftoverMedicationVoucherController@index',
    'permission' => 'layanan-leftover-medication-voucher.leftover-medication-voucher.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1662 => 
  array (
    'controller_action' => 'Modules\\LayananLeftoverMedicationVoucher\\Http\\Controllers\\LeftoverMedicationVoucherController@show',
    'permission' => 'layanan-leftover-medication-voucher.leftover-medication-voucher.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1663 => 
  array (
    'controller_action' => 'Modules\\LayananLeftoverMedicationVoucher\\Http\\Controllers\\LeftoverMedicationVoucherController@store',
    'permission' => 'layanan-leftover-medication-voucher.leftover-medication-voucher.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1664 => 
  array (
    'controller_action' => 'Modules\\LayananLeftoverMedicationVoucher\\Http\\Controllers\\LeftoverMedicationVoucherController@update',
    'permission' => 'layanan-leftover-medication-voucher.leftover-medication-voucher.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1665 => 
  array (
    'controller_action' => 'Modules\\LayananLeftoverMedicationVoucherItem\\Http\\Controllers\\LeftoverMedicationVoucherItemController@index',
    'permission' => 'layanan-leftover-medication-voucher-item.leftover-medication-voucher-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1666 => 
  array (
    'controller_action' => 'Modules\\LayananLeftoverMedicationVoucherItem\\Http\\Controllers\\LeftoverMedicationVoucherItemController@show',
    'permission' => 'layanan-leftover-medication-voucher-item.leftover-medication-voucher-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1667 => 
  array (
    'controller_action' => 'Modules\\LayananLeftoverMedicationVoucherItem\\Http\\Controllers\\LeftoverMedicationVoucherItemController@store',
    'permission' => 'layanan-leftover-medication-voucher-item.leftover-medication-voucher-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1668 => 
  array (
    'controller_action' => 'Modules\\LayananMedicalProcedure\\Http\\Controllers\\MedicalProcedureController@index',
    'permission' => 'layanan-medical-procedure.medical-procedure.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1669 => 
  array (
    'controller_action' => 'Modules\\LayananMedicalProcedure\\Http\\Controllers\\MedicalProcedureController@show',
    'permission' => 'layanan-medical-procedure.medical-procedure.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1670 => 
  array (
    'controller_action' => 'Modules\\LayananMedicalProcedure\\Http\\Controllers\\MedicalProcedureController@store',
    'permission' => 'layanan-medical-procedure.medical-procedure.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1671 => 
  array (
    'controller_action' => 'Modules\\LayananMedicalProcedure\\Http\\Controllers\\MedicalProcedureController@update',
    'permission' => 'layanan-medical-procedure.medical-procedure.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1672 => 
  array (
    'controller_action' => 'Modules\\LayananMedicalProcedureStaff\\Http\\Controllers\\MedicalProcedureStaffController@index',
    'permission' => 'layanan-medical-procedure-staff.medical-procedure-staff.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1673 => 
  array (
    'controller_action' => 'Modules\\LayananMedicalProcedureStaff\\Http\\Controllers\\MedicalProcedureStaffController@show',
    'permission' => 'layanan-medical-procedure-staff.medical-procedure-staff.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1674 => 
  array (
    'controller_action' => 'Modules\\LayananMedicalProcedureStaff\\Http\\Controllers\\MedicalProcedureStaffController@store',
    'permission' => 'layanan-medical-procedure-staff.medical-procedure-staff.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1675 => 
  array (
    'controller_action' => 'Modules\\LayananMedicalProcedureStaff\\Http\\Controllers\\MedicalProcedureStaffController@update',
    'permission' => 'layanan-medical-procedure-staff.medical-procedure-staff.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1676 => 
  array (
    'controller_action' => 'Modules\\LayananMedicalProcedureStaff\\Http\\Controllers\\MedicalProcedureStaffController@destroy',
    'permission' => 'layanan-medical-procedure-staff.medical-procedure-staff.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1677 => 
  array (
    'controller_action' => 'Modules\\LayananMedicalSupplyUsage\\Http\\Controllers\\MedicalSupplyUsageController@index',
    'permission' => 'layanan-medical-supply-usage.medical-supply-usage.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1678 => 
  array (
    'controller_action' => 'Modules\\LayananMedicalSupplyUsage\\Http\\Controllers\\MedicalSupplyUsageController@show',
    'permission' => 'layanan-medical-supply-usage.medical-supply-usage.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1679 => 
  array (
    'controller_action' => 'Modules\\LayananMedicalSupplyUsage\\Http\\Controllers\\MedicalSupplyUsageController@store',
    'permission' => 'layanan-medical-supply-usage.medical-supply-usage.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1680 => 
  array (
    'controller_action' => 'Modules\\LayananMedicalSupplyUsage\\Http\\Controllers\\MedicalSupplyUsageController@update',
    'permission' => 'layanan-medical-supply-usage.medical-supply-usage.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1681 => 
  array (
    'controller_action' => 'Modules\\LayananMedicalSupplyUsageItem\\Http\\Controllers\\MedicalSupplyUsageItemController@index',
    'permission' => 'layanan-medical-supply-usage-item.medical-supply-usage-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1682 => 
  array (
    'controller_action' => 'Modules\\LayananMedicalSupplyUsageItem\\Http\\Controllers\\MedicalSupplyUsageItemController@show',
    'permission' => 'layanan-medical-supply-usage-item.medical-supply-usage-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1683 => 
  array (
    'controller_action' => 'Modules\\LayananMedicalSupplyUsageItem\\Http\\Controllers\\MedicalSupplyUsageItemController@store',
    'permission' => 'layanan-medical-supply-usage-item.medical-supply-usage-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1684 => 
  array (
    'controller_action' => 'Modules\\LayananMedicationIteration\\Http\\Controllers\\MedicationIterationController@index',
    'permission' => 'layanan-medication-iteration.medication-iteration.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1685 => 
  array (
    'controller_action' => 'Modules\\LayananMedicationIteration\\Http\\Controllers\\MedicationIterationController@show',
    'permission' => 'layanan-medication-iteration.medication-iteration.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1686 => 
  array (
    'controller_action' => 'Modules\\LayananMedicationIteration\\Http\\Controllers\\MedicationIterationController@store',
    'permission' => 'layanan-medication-iteration.medication-iteration.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1687 => 
  array (
    'controller_action' => 'Modules\\LayananMedicationIteration\\Http\\Controllers\\MedicationIterationController@update',
    'permission' => 'layanan-medication-iteration.medication-iteration.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1688 => 
  array (
    'controller_action' => 'Modules\\LayananMedicationServiceLimit\\Http\\Controllers\\MedicationServiceLimitController@index',
    'permission' => 'layanan-medication-service-limit.medication-service-limit.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1689 => 
  array (
    'controller_action' => 'Modules\\LayananMedicationServiceLimit\\Http\\Controllers\\MedicationServiceLimitController@show',
    'permission' => 'layanan-medication-service-limit.medication-service-limit.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1690 => 
  array (
    'controller_action' => 'Modules\\LayananMedicationServiceLimit\\Http\\Controllers\\MedicationServiceLimitController@store',
    'permission' => 'layanan-medication-service-limit.medication-service-limit.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1691 => 
  array (
    'controller_action' => 'Modules\\LayananMedicationServiceLimit\\Http\\Controllers\\MedicationServiceLimitController@update',
    'permission' => 'layanan-medication-service-limit.medication-service-limit.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1692 => 
  array (
    'controller_action' => 'Modules\\LayananMedicationServiceLimit\\Http\\Controllers\\MedicationServiceLimitController@destroy',
    'permission' => 'layanan-medication-service-limit.medication-service-limit.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1693 => 
  array (
    'controller_action' => 'Modules\\LayananMedicineDelivery\\Http\\Controllers\\MedicineDeliveryController@index',
    'permission' => 'layanan-medicine-delivery.medicine-delivery.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1694 => 
  array (
    'controller_action' => 'Modules\\LayananMedicineDelivery\\Http\\Controllers\\MedicineDeliveryController@show',
    'permission' => 'layanan-medicine-delivery.medicine-delivery.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1695 => 
  array (
    'controller_action' => 'Modules\\LayananMedicineDelivery\\Http\\Controllers\\MedicineDeliveryController@store',
    'permission' => 'layanan-medicine-delivery.medicine-delivery.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1696 => 
  array (
    'controller_action' => 'Modules\\LayananMedicineDelivery\\Http\\Controllers\\MedicineDeliveryController@update',
    'permission' => 'layanan-medicine-delivery.medicine-delivery.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1697 => 
  array (
    'controller_action' => 'Modules\\LayananMedicineDelivery\\Http\\Controllers\\MedicineDeliveryController@destroy',
    'permission' => 'layanan-medicine-delivery.medicine-delivery.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1698 => 
  array (
    'controller_action' => 'Modules\\LayananMedicineDelivery\\Http\\Controllers\\MedicineDeliveryController@assignCourier',
    'permission' => 'layanan-medicine-delivery.medicine-delivery.assign-courier',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1699 => 
  array (
    'controller_action' => 'Modules\\LayananMedicineDelivery\\Http\\Controllers\\MedicineDeliveryController@markDelivered',
    'permission' => 'layanan-medicine-delivery.medicine-delivery.mark-delivered',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1700 => 
  array (
    'controller_action' => 'Modules\\LayananMortuaryRecord\\Http\\Controllers\\MortuaryRecordController@index',
    'permission' => 'layanan-mortuary-record.mortuary-record.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1701 => 
  array (
    'controller_action' => 'Modules\\LayananMortuaryRecord\\Http\\Controllers\\MortuaryRecordController@show',
    'permission' => 'layanan-mortuary-record.mortuary-record.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1702 => 
  array (
    'controller_action' => 'Modules\\LayananMortuaryRecord\\Http\\Controllers\\MortuaryRecordController@store',
    'permission' => 'layanan-mortuary-record.mortuary-record.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1703 => 
  array (
    'controller_action' => 'Modules\\LayananMortuaryRecord\\Http\\Controllers\\MortuaryRecordController@update',
    'permission' => 'layanan-mortuary-record.mortuary-record.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1704 => 
  array (
    'controller_action' => 'Modules\\LayananMortuaryRecord\\Http\\Controllers\\MortuaryRecordController@destroy',
    'permission' => 'layanan-mortuary-record.mortuary-record.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1705 => 
  array (
    'controller_action' => 'Modules\\LayananMortuaryRecord\\Http\\Controllers\\MortuaryRecordController@release',
    'permission' => 'layanan-mortuary-record.mortuary-record.release',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1706 => 
  array (
    'controller_action' => 'Modules\\LayananOxygenUsage\\Http\\Controllers\\OxygenUsageController@index',
    'permission' => 'layanan-oxygen-usage.oxygen-usage.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1707 => 
  array (
    'controller_action' => 'Modules\\LayananOxygenUsage\\Http\\Controllers\\OxygenUsageController@show',
    'permission' => 'layanan-oxygen-usage.oxygen-usage.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1708 => 
  array (
    'controller_action' => 'Modules\\LayananOxygenUsage\\Http\\Controllers\\OxygenUsageController@store',
    'permission' => 'layanan-oxygen-usage.oxygen-usage.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1709 => 
  array (
    'controller_action' => 'Modules\\LayananOxygenUsage\\Http\\Controllers\\OxygenUsageController@update',
    'permission' => 'layanan-oxygen-usage.oxygen-usage.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1710 => 
  array (
    'controller_action' => 'Modules\\LayananPathologyAnatomyResult\\Http\\Controllers\\PathologyAnatomyResultController@index',
    'permission' => 'layanan-pathology-anatomy-result.pathology-anatomy-result.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1711 => 
  array (
    'controller_action' => 'Modules\\LayananPathologyAnatomyResult\\Http\\Controllers\\PathologyAnatomyResultController@show',
    'permission' => 'layanan-pathology-anatomy-result.pathology-anatomy-result.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1712 => 
  array (
    'controller_action' => 'Modules\\LayananPathologyAnatomyResult\\Http\\Controllers\\PathologyAnatomyResultController@store',
    'permission' => 'layanan-pathology-anatomy-result.pathology-anatomy-result.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1713 => 
  array (
    'controller_action' => 'Modules\\LayananPathologyAnatomyResult\\Http\\Controllers\\PathologyAnatomyResultController@update',
    'permission' => 'layanan-pathology-anatomy-result.pathology-anatomy-result.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1714 => 
  array (
    'controller_action' => 'Modules\\LayananPathologyImmunofluorescenceResult\\Http\\Controllers\\PathologyImmunofluorescenceResultController@index',
    'permission' => 'layanan-pathology-immunofluorescence-result.pathology-immunofluorescence-result.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1715 => 
  array (
    'controller_action' => 'Modules\\LayananPathologyImmunofluorescenceResult\\Http\\Controllers\\PathologyImmunofluorescenceResultController@show',
    'permission' => 'layanan-pathology-immunofluorescence-result.pathology-immunofluorescence-result.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1716 => 
  array (
    'controller_action' => 'Modules\\LayananPathologyImmunofluorescenceResult\\Http\\Controllers\\PathologyImmunofluorescenceResultController@store',
    'permission' => 'layanan-pathology-immunofluorescence-result.pathology-immunofluorescence-result.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1717 => 
  array (
    'controller_action' => 'Modules\\LayananPathologyMolecularResult\\Http\\Controllers\\PathologyMolecularResultController@index',
    'permission' => 'layanan-pathology-molecular-result.pathology-molecular-result.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1718 => 
  array (
    'controller_action' => 'Modules\\LayananPathologyMolecularResult\\Http\\Controllers\\PathologyMolecularResultController@show',
    'permission' => 'layanan-pathology-molecular-result.pathology-molecular-result.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1719 => 
  array (
    'controller_action' => 'Modules\\LayananPathologyMolecularResult\\Http\\Controllers\\PathologyMolecularResultController@store',
    'permission' => 'layanan-pathology-molecular-result.pathology-molecular-result.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1720 => 
  array (
    'controller_action' => 'Modules\\LayananPatientComplaint\\Http\\Controllers\\PatientComplaintController@summary',
    'permission' => 'layanan-patient-complaint.patient-complaint.summary',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1721 => 
  array (
    'controller_action' => 'Modules\\LayananPatientComplaint\\Http\\Controllers\\PatientComplaintController@index',
    'permission' => 'layanan-patient-complaint.patient-complaint.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1722 => 
  array (
    'controller_action' => 'Modules\\LayananPatientComplaint\\Http\\Controllers\\PatientComplaintController@show',
    'permission' => 'layanan-patient-complaint.patient-complaint.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1723 => 
  array (
    'controller_action' => 'Modules\\LayananPatientComplaint\\Http\\Controllers\\PatientSurveyController@index',
    'permission' => 'layanan-patient-complaint.patient-survey.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1724 => 
  array (
    'controller_action' => 'Modules\\LayananPatientComplaint\\Http\\Controllers\\PatientSurveyController@show',
    'permission' => 'layanan-patient-complaint.patient-survey.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1725 => 
  array (
    'controller_action' => 'Modules\\LayananPatientComplaint\\Http\\Controllers\\PatientComplaintController@store',
    'permission' => 'layanan-patient-complaint.patient-complaint.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1726 => 
  array (
    'controller_action' => 'Modules\\LayananPatientComplaint\\Http\\Controllers\\PatientComplaintController@update',
    'permission' => 'layanan-patient-complaint.patient-complaint.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1727 => 
  array (
    'controller_action' => 'Modules\\LayananPatientComplaint\\Http\\Controllers\\PatientComplaintController@destroy',
    'permission' => 'layanan-patient-complaint.patient-complaint.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1728 => 
  array (
    'controller_action' => 'Modules\\LayananPatientComplaint\\Http\\Controllers\\PatientSurveyController@store',
    'permission' => 'layanan-patient-complaint.patient-survey.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1729 => 
  array (
    'controller_action' => 'Modules\\LayananPatientComplaint\\Http\\Controllers\\PatientSurveyController@update',
    'permission' => 'layanan-patient-complaint.patient-survey.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1730 => 
  array (
    'controller_action' => 'Modules\\LayananPatientComplaint\\Http\\Controllers\\PatientSurveyController@destroy',
    'permission' => 'layanan-patient-complaint.patient-survey.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1731 => 
  array (
    'controller_action' => 'Modules\\LayananPatientDeathRecord\\Http\\Controllers\\PatientDeathRecordController@index',
    'permission' => 'layanan-patient-death-record.patient-death-record.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1732 => 
  array (
    'controller_action' => 'Modules\\LayananPatientDeathRecord\\Http\\Controllers\\PatientDeathRecordController@show',
    'permission' => 'layanan-patient-death-record.patient-death-record.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1733 => 
  array (
    'controller_action' => 'Modules\\LayananPatientDeathRecord\\Http\\Controllers\\PatientDeathRecordController@store',
    'permission' => 'layanan-patient-death-record.patient-death-record.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1734 => 
  array (
    'controller_action' => 'Modules\\LayananPatientDeathRecord\\Http\\Controllers\\PatientDeathRecordController@update',
    'permission' => 'layanan-patient-death-record.patient-death-record.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1735 => 
  array (
    'controller_action' => 'Modules\\LayananPatientDischargeRecord\\Http\\Controllers\\PatientDischargeRecordController@index',
    'permission' => 'layanan-patient-discharge-record.patient-discharge-record.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1736 => 
  array (
    'controller_action' => 'Modules\\LayananPatientDischargeRecord\\Http\\Controllers\\PatientDischargeRecordController@show',
    'permission' => 'layanan-patient-discharge-record.patient-discharge-record.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1737 => 
  array (
    'controller_action' => 'Modules\\LayananPatientDischargeRecord\\Http\\Controllers\\PatientDischargeRecordController@store',
    'permission' => 'layanan-patient-discharge-record.patient-discharge-record.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1738 => 
  array (
    'controller_action' => 'Modules\\LayananPatientDischargeRecord\\Http\\Controllers\\PatientDischargeRecordController@update',
    'permission' => 'layanan-patient-discharge-record.patient-discharge-record.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1739 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyDispense\\Http\\Controllers\\PharmacyDispenseController@index',
    'permission' => 'layanan-pharmacy-dispense.pharmacy-dispense.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1740 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyDispense\\Http\\Controllers\\PharmacyDispenseController@show',
    'permission' => 'layanan-pharmacy-dispense.pharmacy-dispense.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1741 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyDispense\\Http\\Controllers\\PharmacyDispenseController@store',
    'permission' => 'layanan-pharmacy-dispense.pharmacy-dispense.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1742 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyDispense\\Http\\Controllers\\PharmacyDispenseController@update',
    'permission' => 'layanan-pharmacy-dispense.pharmacy-dispense.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1743 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyDispense\\Http\\Controllers\\DispenseController@store',
    'permission' => 'layanan-pharmacy-dispense.dispense.store',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1744 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyOutpatientQueue\\Http\\Controllers\\PharmacyOutpatientQueueController@index',
    'permission' => 'layanan-pharmacy-outpatient-queue.pharmacy-outpatient-queue.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1745 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyOutpatientQueue\\Http\\Controllers\\PharmacyOutpatientQueueController@show',
    'permission' => 'layanan-pharmacy-outpatient-queue.pharmacy-outpatient-queue.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1746 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyOutpatientQueue\\Http\\Controllers\\PharmacyOutpatientQueueController@store',
    'permission' => 'layanan-pharmacy-outpatient-queue.pharmacy-outpatient-queue.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1747 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyOutpatientQueue\\Http\\Controllers\\PharmacyOutpatientQueueController@update',
    'permission' => 'layanan-pharmacy-outpatient-queue.pharmacy-outpatient-queue.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1748 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyReturn\\Http\\Controllers\\PharmacyReturnController@index',
    'permission' => 'layanan-pharmacy-return.pharmacy-return.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1749 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyReturn\\Http\\Controllers\\PharmacyReturnController@show',
    'permission' => 'layanan-pharmacy-return.pharmacy-return.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1750 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyReturn\\Http\\Controllers\\PharmacyReturnController@store',
    'permission' => 'layanan-pharmacy-return.pharmacy-return.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1751 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyReturn\\Http\\Controllers\\PharmacyReturnController@update',
    'permission' => 'layanan-pharmacy-return.pharmacy-return.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1752 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyReturn\\Http\\Controllers\\PharmacyReturnController@destroy',
    'permission' => 'layanan-pharmacy-return.pharmacy-return.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1753 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyServiceFee\\Http\\Controllers\\PharmacyServiceFeeController@index',
    'permission' => 'layanan-pharmacy-service-fee.pharmacy-service-fee.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1754 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyServiceFee\\Http\\Controllers\\PharmacyServiceFeeController@show',
    'permission' => 'layanan-pharmacy-service-fee.pharmacy-service-fee.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1755 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyServiceFee\\Http\\Controllers\\PharmacyServiceFeeController@store',
    'permission' => 'layanan-pharmacy-service-fee.pharmacy-service-fee.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1756 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyServiceFee\\Http\\Controllers\\PharmacyServiceFeeController@update',
    'permission' => 'layanan-pharmacy-service-fee.pharmacy-service-fee.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1757 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyServiceFee\\Http\\Controllers\\PharmacyServiceFeeController@destroy',
    'permission' => 'layanan-pharmacy-service-fee.pharmacy-service-fee.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1758 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyServiceTime\\Http\\Controllers\\PharmacyServiceTimeController@index',
    'permission' => 'layanan-pharmacy-service-time.pharmacy-service-time.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1759 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyServiceTime\\Http\\Controllers\\PharmacyServiceTimeController@show',
    'permission' => 'layanan-pharmacy-service-time.pharmacy-service-time.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1760 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyServiceTime\\Http\\Controllers\\PharmacyServiceTimeController@store',
    'permission' => 'layanan-pharmacy-service-time.pharmacy-service-time.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1761 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyServiceTime\\Http\\Controllers\\PharmacyServiceTimeController@update',
    'permission' => 'layanan-pharmacy-service-time.pharmacy-service-time.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1762 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyServiceTime\\Http\\Controllers\\PharmacyServiceTimeController@destroy',
    'permission' => 'layanan-pharmacy-service-time.pharmacy-service-time.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1763 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyServiceTimeStage\\Http\\Controllers\\PharmacyServiceTimeStageController@index',
    'permission' => 'layanan-pharmacy-service-time-stage.pharmacy-service-time-stage.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1764 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyServiceTimeStage\\Http\\Controllers\\PharmacyServiceTimeStageController@show',
    'permission' => 'layanan-pharmacy-service-time-stage.pharmacy-service-time-stage.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1765 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyServiceTimeStage\\Http\\Controllers\\PharmacyServiceTimeStageController@store',
    'permission' => 'layanan-pharmacy-service-time-stage.pharmacy-service-time-stage.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1766 => 
  array (
    'controller_action' => 'Modules\\LayananPharmacyServiceTimeStage\\Http\\Controllers\\PharmacyServiceTimeStageController@destroy',
    'permission' => 'layanan-pharmacy-service-time-stage.pharmacy-service-time-stage.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1767 => 
  array (
    'controller_action' => 'Modules\\LayananPrescription\\Http\\Controllers\\PrescriptionController@index',
    'permission' => 'layanan-prescription.prescription.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1768 => 
  array (
    'controller_action' => 'Modules\\LayananPrescription\\Http\\Controllers\\PrescriptionController@show',
    'permission' => 'layanan-prescription.prescription.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1769 => 
  array (
    'controller_action' => 'Modules\\LayananPrescription\\Http\\Controllers\\PrescriptionController@store',
    'permission' => 'layanan-prescription.prescription.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1770 => 
  array (
    'controller_action' => 'Modules\\LayananPrescription\\Http\\Controllers\\PrescriptionController@cancel',
    'permission' => 'layanan-prescription.prescription.cancel',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1771 => 
  array (
    'controller_action' => 'Modules\\LayananPrescriptionFulfillment\\Http\\Controllers\\PrescriptionFulfillmentController@index',
    'permission' => 'layanan-prescription-fulfillment.prescription-fulfillment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1772 => 
  array (
    'controller_action' => 'Modules\\LayananPrescriptionFulfillment\\Http\\Controllers\\PrescriptionFulfillmentController@show',
    'permission' => 'layanan-prescription-fulfillment.prescription-fulfillment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1773 => 
  array (
    'controller_action' => 'Modules\\LayananPrescriptionFulfillment\\Http\\Controllers\\PrescriptionFulfillmentController@store',
    'permission' => 'layanan-prescription-fulfillment.prescription-fulfillment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1774 => 
  array (
    'controller_action' => 'Modules\\LayananPrescriptionFulfillment\\Http\\Controllers\\PrescriptionFulfillmentController@update',
    'permission' => 'layanan-prescription-fulfillment.prescription-fulfillment.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1775 => 
  array (
    'controller_action' => 'Modules\\LayananPrescriptionFulfillment\\Http\\Controllers\\PrescriptionFulfillmentController@destroy',
    'permission' => 'layanan-prescription-fulfillment.prescription-fulfillment.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1776 => 
  array (
    'controller_action' => 'Modules\\LayananPrescriptionFulfillmentItem\\Http\\Controllers\\PrescriptionFulfillmentItemController@index',
    'permission' => 'layanan-prescription-fulfillment-item.prescription-fulfillment-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1777 => 
  array (
    'controller_action' => 'Modules\\LayananPrescriptionFulfillmentItem\\Http\\Controllers\\PrescriptionFulfillmentItemController@show',
    'permission' => 'layanan-prescription-fulfillment-item.prescription-fulfillment-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1778 => 
  array (
    'controller_action' => 'Modules\\LayananPrescriptionFulfillmentItem\\Http\\Controllers\\PrescriptionFulfillmentItemController@store',
    'permission' => 'layanan-prescription-fulfillment-item.prescription-fulfillment-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1779 => 
  array (
    'controller_action' => 'Modules\\LayananPrescriptionFulfillmentItem\\Http\\Controllers\\PrescriptionFulfillmentItemController@update',
    'permission' => 'layanan-prescription-fulfillment-item.prescription-fulfillment-item.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1780 => 
  array (
    'controller_action' => 'Modules\\LayananPrescriptionFulfillmentItem\\Http\\Controllers\\PrescriptionFulfillmentItemController@destroy',
    'permission' => 'layanan-prescription-fulfillment-item.prescription-fulfillment-item.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1781 => 
  array (
    'controller_action' => 'Modules\\LayananPrescriptionInitialReview\\Http\\Controllers\\PrescriptionInitialReviewController@index',
    'permission' => 'layanan-prescription-initial-review.prescription-initial-review.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1782 => 
  array (
    'controller_action' => 'Modules\\LayananPrescriptionInitialReview\\Http\\Controllers\\PrescriptionInitialReviewController@show',
    'permission' => 'layanan-prescription-initial-review.prescription-initial-review.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1783 => 
  array (
    'controller_action' => 'Modules\\LayananPrescriptionInitialReview\\Http\\Controllers\\PrescriptionInitialReviewController@store',
    'permission' => 'layanan-prescription-initial-review.prescription-initial-review.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1784 => 
  array (
    'controller_action' => 'Modules\\LayananPrescriptionInitialReview\\Http\\Controllers\\PrescriptionInitialReviewController@update',
    'permission' => 'layanan-prescription-initial-review.prescription-initial-review.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1785 => 
  array (
    'controller_action' => 'Modules\\LayananPrescriptionInitialReview\\Http\\Controllers\\PrescriptionInitialReviewController@destroy',
    'permission' => 'layanan-prescription-initial-review.prescription-initial-review.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1786 => 
  array (
    'controller_action' => 'Modules\\LayananPrescriptionItem\\Http\\Controllers\\PrescriptionItemController@index',
    'permission' => 'layanan-prescription-item.prescription-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1787 => 
  array (
    'controller_action' => 'Modules\\LayananPrescriptionItem\\Http\\Controllers\\PrescriptionItemController@show',
    'permission' => 'layanan-prescription-item.prescription-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1788 => 
  array (
    'controller_action' => 'Modules\\LayananPrescriptionItem\\Http\\Controllers\\PrescriptionItemController@store',
    'permission' => 'layanan-prescription-item.prescription-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1789 => 
  array (
    'controller_action' => 'Modules\\LayananRadiologyOrder\\Http\\Controllers\\RadiologyOrderController@index',
    'permission' => 'layanan-radiology-order.radiology-order.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1790 => 
  array (
    'controller_action' => 'Modules\\LayananRadiologyOrder\\Http\\Controllers\\RadiologyOrderController@show',
    'permission' => 'layanan-radiology-order.radiology-order.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1791 => 
  array (
    'controller_action' => 'Modules\\LayananRadiologyOrder\\Http\\Controllers\\RadiologyOrderController@store',
    'permission' => 'layanan-radiology-order.radiology-order.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1792 => 
  array (
    'controller_action' => 'Modules\\LayananRadiologyOrder\\Http\\Controllers\\RadiologyOrderController@update',
    'permission' => 'layanan-radiology-order.radiology-order.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1793 => 
  array (
    'controller_action' => 'Modules\\LayananRadiologyOrder\\Http\\Controllers\\RadiologyOrderController@schedule',
    'permission' => 'layanan-radiology-order.radiology-order.schedule',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1794 => 
  array (
    'controller_action' => 'Modules\\LayananRadiologyOrder\\Http\\Controllers\\RadiologyOrderController@cancel',
    'permission' => 'layanan-radiology-order.radiology-order.cancel',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1795 => 
  array (
    'controller_action' => 'Modules\\LayananRadiologyOrderItem\\Http\\Controllers\\RadiologyOrderItemController@index',
    'permission' => 'layanan-radiology-order-item.radiology-order-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1796 => 
  array (
    'controller_action' => 'Modules\\LayananRadiologyOrderItem\\Http\\Controllers\\RadiologyOrderItemController@show',
    'permission' => 'layanan-radiology-order-item.radiology-order-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1797 => 
  array (
    'controller_action' => 'Modules\\LayananRadiologyOrderItem\\Http\\Controllers\\RadiologyOrderItemController@store',
    'permission' => 'layanan-radiology-order-item.radiology-order-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1798 => 
  array (
    'controller_action' => 'Modules\\LayananRadiologyResult\\Http\\Controllers\\RadiologyResultController@index',
    'permission' => 'layanan-radiology-result.radiology-result.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1799 => 
  array (
    'controller_action' => 'Modules\\LayananRadiologyResult\\Http\\Controllers\\RadiologyResultController@show',
    'permission' => 'layanan-radiology-result.radiology-result.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1800 => 
  array (
    'controller_action' => 'Modules\\LayananRadiologyResult\\Http\\Controllers\\RadiologyResultController@store',
    'permission' => 'layanan-radiology-result.radiology-result.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1801 => 
  array (
    'controller_action' => 'Modules\\LayananRadiologyResult\\Http\\Controllers\\RadiologyResultController@update',
    'permission' => 'layanan-radiology-result.radiology-result.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1802 => 
  array (
    'controller_action' => 'Modules\\LayananRadiologyViewerLog\\Http\\Controllers\\RadiologyViewerLogController@index',
    'permission' => 'layanan-radiology-viewer-log.radiology-viewer-log.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1803 => 
  array (
    'controller_action' => 'Modules\\LayananRadiologyViewerLog\\Http\\Controllers\\RadiologyViewerLogController@show',
    'permission' => 'layanan-radiology-viewer-log.radiology-viewer-log.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1804 => 
  array (
    'controller_action' => 'Modules\\LayananRadiologyViewerLog\\Http\\Controllers\\RadiologyViewerLogController@store',
    'permission' => 'layanan-radiology-viewer-log.radiology-viewer-log.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1805 => 
  array (
    'controller_action' => 'Modules\\LayananRadiologyViewerLog\\Http\\Controllers\\RadiologyViewerLogController@destroy',
    'permission' => 'layanan-radiology-viewer-log.radiology-viewer-log.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1806 => 
  array (
    'controller_action' => 'Modules\\LayananSurgicalSafetyEvaluationResult\\Http\\Controllers\\SurgicalSafetyEvaluationResultController@index',
    'permission' => 'layanan-surgical-safety-evaluation-result.surgical-safety-evaluation-result.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1807 => 
  array (
    'controller_action' => 'Modules\\LayananSurgicalSafetyEvaluationResult\\Http\\Controllers\\SurgicalSafetyEvaluationResultController@show',
    'permission' => 'layanan-surgical-safety-evaluation-result.surgical-safety-evaluation-result.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1808 => 
  array (
    'controller_action' => 'Modules\\LayananSurgicalSafetyEvaluationResult\\Http\\Controllers\\SurgicalSafetyEvaluationResultController@store',
    'permission' => 'layanan-surgical-safety-evaluation-result.surgical-safety-evaluation-result.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1809 => 
  array (
    'controller_action' => 'Modules\\LayananTelemedicineSession\\Http\\Controllers\\TelemedicineSessionController@index',
    'permission' => 'layanan-telemedicine-session.telemedicine-session.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1810 => 
  array (
    'controller_action' => 'Modules\\LayananTelemedicineSession\\Http\\Controllers\\TelemedicineSessionController@show',
    'permission' => 'layanan-telemedicine-session.telemedicine-session.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1811 => 
  array (
    'controller_action' => 'Modules\\LayananTelemedicineSession\\Http\\Controllers\\TelemedicineSessionController@store',
    'permission' => 'layanan-telemedicine-session.telemedicine-session.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1812 => 
  array (
    'controller_action' => 'Modules\\LayananTelemedicineSession\\Http\\Controllers\\TelemedicineSessionController@update',
    'permission' => 'layanan-telemedicine-session.telemedicine-session.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1813 => 
  array (
    'controller_action' => 'Modules\\LayananTelemedicineSession\\Http\\Controllers\\TelemedicineSessionController@destroy',
    'permission' => 'layanan-telemedicine-session.telemedicine-session.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1814 => 
  array (
    'controller_action' => 'Modules\\LayananTelemedicineSession\\Http\\Controllers\\TelemedicineSessionController@start',
    'permission' => 'layanan-telemedicine-session.telemedicine-session.start',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1815 => 
  array (
    'controller_action' => 'Modules\\LayananTelemedicineSession\\Http\\Controllers\\TelemedicineSessionController@complete',
    'permission' => 'layanan-telemedicine-session.telemedicine-session.complete',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1816 => 
  array (
    'controller_action' => 'Modules\\LayananTreatmentProtocol\\Http\\Controllers\\TreatmentProtocolController@index',
    'permission' => 'layanan-treatment-protocol.treatment-protocol.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1817 => 
  array (
    'controller_action' => 'Modules\\LayananTreatmentProtocol\\Http\\Controllers\\TreatmentProtocolController@show',
    'permission' => 'layanan-treatment-protocol.treatment-protocol.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1818 => 
  array (
    'controller_action' => 'Modules\\LayananTreatmentProtocol\\Http\\Controllers\\TreatmentProtocolController@store',
    'permission' => 'layanan-treatment-protocol.treatment-protocol.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1819 => 
  array (
    'controller_action' => 'Modules\\LayananTreatmentProtocol\\Http\\Controllers\\TreatmentProtocolController@update',
    'permission' => 'layanan-treatment-protocol.treatment-protocol.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1820 => 
  array (
    'controller_action' => 'Modules\\LayananTreatmentProtocol\\Http\\Controllers\\TreatmentProtocolController@destroy',
    'permission' => 'layanan-treatment-protocol.treatment-protocol.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1821 => 
  array (
    'controller_action' => 'Modules\\LayananTreatmentProtocolStep\\Http\\Controllers\\TreatmentProtocolStepController@index',
    'permission' => 'layanan-treatment-protocol-step.treatment-protocol-step.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1822 => 
  array (
    'controller_action' => 'Modules\\LayananTreatmentProtocolStep\\Http\\Controllers\\TreatmentProtocolStepController@show',
    'permission' => 'layanan-treatment-protocol-step.treatment-protocol-step.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1823 => 
  array (
    'controller_action' => 'Modules\\LayananTreatmentProtocolStep\\Http\\Controllers\\TreatmentProtocolStepController@store',
    'permission' => 'layanan-treatment-protocol-step.treatment-protocol-step.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1824 => 
  array (
    'controller_action' => 'Modules\\LayananTreatmentProtocolStep\\Http\\Controllers\\TreatmentProtocolStepController@update',
    'permission' => 'layanan-treatment-protocol-step.treatment-protocol-step.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1825 => 
  array (
    'controller_action' => 'Modules\\LayananTreatmentProtocolStep\\Http\\Controllers\\TreatmentProtocolStepController@destroy',
    'permission' => 'layanan-treatment-protocol-step.treatment-protocol-step.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1826 => 
  array (
    'controller_action' => 'Modules\\LayananTreatmentProtocolStepDrug\\Http\\Controllers\\TreatmentProtocolStepDrugController@index',
    'permission' => 'layanan-treatment-protocol-step-drug.treatment-protocol-step-drug.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1827 => 
  array (
    'controller_action' => 'Modules\\LayananTreatmentProtocolStepDrug\\Http\\Controllers\\TreatmentProtocolStepDrugController@show',
    'permission' => 'layanan-treatment-protocol-step-drug.treatment-protocol-step-drug.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1828 => 
  array (
    'controller_action' => 'Modules\\LayananTreatmentProtocolStepDrug\\Http\\Controllers\\TreatmentProtocolStepDrugController@store',
    'permission' => 'layanan-treatment-protocol-step-drug.treatment-protocol-step-drug.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1829 => 
  array (
    'controller_action' => 'Modules\\LayananTreatmentProtocolStepDrug\\Http\\Controllers\\TreatmentProtocolStepDrugController@update',
    'permission' => 'layanan-treatment-protocol-step-drug.treatment-protocol-step-drug.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1830 => 
  array (
    'controller_action' => 'Modules\\LayananTreatmentProtocolStepDrug\\Http\\Controllers\\TreatmentProtocolStepDrugController@destroy',
    'permission' => 'layanan-treatment-protocol-step-drug.treatment-protocol-step-drug.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1831 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAbciProcedure\\Http\\Controllers\\AbciProcedureController@index',
    'permission' => 'medical-record-abci-procedure.abci-procedure.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1832 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAbciProcedure\\Http\\Controllers\\AbciProcedureController@show',
    'permission' => 'medical-record-abci-procedure.abci-procedure.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1833 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAbciProcedure\\Http\\Controllers\\AbciProcedureController@store',
    'permission' => 'medical-record-abci-procedure.abci-procedure.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1834 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAbciProcedure\\Http\\Controllers\\AbciProcedureController@update',
    'permission' => 'medical-record-abci-procedure.abci-procedure.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1835 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAbciProcedure\\Http\\Controllers\\AbciProcedureController@destroy',
    'permission' => 'medical-record-abci-procedure.abci-procedure.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1836 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAbdomenExamination\\Http\\Controllers\\AbdomenExaminationController@index',
    'permission' => 'medical-record-abdomen-examination.abdomen-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1837 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAbdomenExamination\\Http\\Controllers\\AbdomenExaminationController@show',
    'permission' => 'medical-record-abdomen-examination.abdomen-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1838 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAbdomenExamination\\Http\\Controllers\\AbdomenExaminationController@store',
    'permission' => 'medical-record-abdomen-examination.abdomen-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1839 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAbdomenExamination\\Http\\Controllers\\AbdomenExaminationController@update',
    'permission' => 'medical-record-abdomen-examination.abdomen-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1840 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAbdomenExamination\\Http\\Controllers\\AbdomenExaminationController@destroy',
    'permission' => 'medical-record-abdomen-examination.abdomen-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1841 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAdmissionMedicationReconciliation\\Http\\Controllers\\AdmissionMedicationReconciliationController@index',
    'permission' => 'medical-record-admission-medication-reconciliation.admission-medication-reconciliation.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1842 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAdmissionMedicationReconciliation\\Http\\Controllers\\AdmissionMedicationReconciliationController@show',
    'permission' => 'medical-record-admission-medication-reconciliation.admission-medication-reconciliation.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1843 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAdmissionMedicationReconciliation\\Http\\Controllers\\AdmissionMedicationReconciliationController@store',
    'permission' => 'medical-record-admission-medication-reconciliation.admission-medication-reconciliation.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1844 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAdmissionMedicationReconciliation\\Http\\Controllers\\AdmissionMedicationReconciliationController@update',
    'permission' => 'medical-record-admission-medication-reconciliation.admission-medication-reconciliation.update',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1845 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAdmissionMedicationReconciliationItem\\Http\\Controllers\\AdmissionMedicationReconciliationItemController@index',
    'permission' => 'medical-record-admission-medication-reconciliation-item.admission-medication-reconciliation-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1846 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAdmissionMedicationReconciliationItem\\Http\\Controllers\\AdmissionMedicationReconciliationItemController@show',
    'permission' => 'medical-record-admission-medication-reconciliation-item.admission-medication-reconciliation-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1847 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAdmissionMedicationReconciliationItem\\Http\\Controllers\\AdmissionMedicationReconciliationItemController@store',
    'permission' => 'medical-record-admission-medication-reconciliation-item.admission-medication-reconciliation-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1848 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAllergy\\Http\\Controllers\\AllergyController@index',
    'permission' => 'medical-record-allergy.allergy.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1849 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAllergy\\Http\\Controllers\\AllergyController@show',
    'permission' => 'medical-record-allergy.allergy.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1850 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAllergy\\Http\\Controllers\\AllergyController@store',
    'permission' => 'medical-record-allergy.allergy.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1851 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAllergy\\Http\\Controllers\\AllergyController@update',
    'permission' => 'medical-record-allergy.allergy.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1852 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAnalExamination\\Http\\Controllers\\AnalExaminationController@index',
    'permission' => 'medical-record-anal-examination.anal-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1853 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAnalExamination\\Http\\Controllers\\AnalExaminationController@show',
    'permission' => 'medical-record-anal-examination.anal-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1854 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAnalExamination\\Http\\Controllers\\AnalExaminationController@store',
    'permission' => 'medical-record-anal-examination.anal-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1855 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAnalExamination\\Http\\Controllers\\AnalExaminationController@update',
    'permission' => 'medical-record-anal-examination.anal-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1856 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAnalExamination\\Http\\Controllers\\AnalExaminationController@destroy',
    'permission' => 'medical-record-anal-examination.anal-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1857 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAnamnesis\\Http\\Controllers\\AnamnesisController@index',
    'permission' => 'medical-record-anamnesis.anamnesis.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1858 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAnamnesis\\Http\\Controllers\\AnamnesisController@show',
    'permission' => 'medical-record-anamnesis.anamnesis.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1859 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAnamnesis\\Http\\Controllers\\AnamnesisController@store',
    'permission' => 'medical-record-anamnesis.anamnesis.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1860 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAnamnesis\\Http\\Controllers\\AnamnesisController@update',
    'permission' => 'medical-record-anamnesis.anamnesis.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1861 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAnamnesis\\Http\\Controllers\\AnamnesisController@destroy',
    'permission' => 'medical-record-anamnesis.anamnesis.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1862 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAnamnesisSource\\Http\\Controllers\\AnamnesisSourceController@index',
    'permission' => 'medical-record-anamnesis-source.anamnesis-source.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1863 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAnamnesisSource\\Http\\Controllers\\AnamnesisSourceController@show',
    'permission' => 'medical-record-anamnesis-source.anamnesis-source.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1864 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAnamnesisSource\\Http\\Controllers\\AnamnesisSourceController@store',
    'permission' => 'medical-record-anamnesis-source.anamnesis-source.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1865 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAnamnesisSource\\Http\\Controllers\\AnamnesisSourceController@update',
    'permission' => 'medical-record-anamnesis-source.anamnesis-source.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1866 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAnamnesisSource\\Http\\Controllers\\AnamnesisSourceController@destroy',
    'permission' => 'medical-record-anamnesis-source.anamnesis-source.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1867 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAnesthesiaPreparation\\Http\\Controllers\\AnesthesiaPreparationController@index',
    'permission' => 'medical-record-anesthesia-preparation.anesthesia-preparation.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1868 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAnesthesiaPreparation\\Http\\Controllers\\AnesthesiaPreparationController@show',
    'permission' => 'medical-record-anesthesia-preparation.anesthesia-preparation.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1869 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordAnesthesiaPreparation\\Http\\Controllers\\AnesthesiaPreparationController@store',
    'permission' => 'medical-record-anesthesia-preparation.anesthesia-preparation.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1870 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBackExamination\\Http\\Controllers\\BackExaminationController@index',
    'permission' => 'medical-record-back-examination.back-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1871 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBackExamination\\Http\\Controllers\\BackExaminationController@show',
    'permission' => 'medical-record-back-examination.back-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1872 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBackExamination\\Http\\Controllers\\BackExaminationController@store',
    'permission' => 'medical-record-back-examination.back-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1873 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBackExamination\\Http\\Controllers\\BackExaminationController@update',
    'permission' => 'medical-record-back-examination.back-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1874 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBackExamination\\Http\\Controllers\\BackExaminationController@destroy',
    'permission' => 'medical-record-back-examination.back-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1875 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepAnxietyDetail\\Http\\Controllers\\BaepAnxietyDetailController@index',
    'permission' => 'medical-record-baep-anxiety-detail.baep-anxiety-detail.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1876 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepAnxietyDetail\\Http\\Controllers\\BaepAnxietyDetailController@show',
    'permission' => 'medical-record-baep-anxiety-detail.baep-anxiety-detail.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1877 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepAnxietyDetail\\Http\\Controllers\\BaepAnxietyDetailController@store',
    'permission' => 'medical-record-baep-anxiety-detail.baep-anxiety-detail.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1878 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepCognitiveDetail\\Http\\Controllers\\BaepCognitiveDetailController@index',
    'permission' => 'medical-record-baep-cognitive-detail.baep-cognitive-detail.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1879 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepCognitiveDetail\\Http\\Controllers\\BaepCognitiveDetailController@show',
    'permission' => 'medical-record-baep-cognitive-detail.baep-cognitive-detail.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1880 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepCognitiveDetail\\Http\\Controllers\\BaepCognitiveDetailController@store',
    'permission' => 'medical-record-baep-cognitive-detail.baep-cognitive-detail.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1881 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepDepressionDetail\\Http\\Controllers\\BaepDepressionDetailController@index',
    'permission' => 'medical-record-baep-depression-detail.baep-depression-detail.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1882 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepDepressionDetail\\Http\\Controllers\\BaepDepressionDetailController@show',
    'permission' => 'medical-record-baep-depression-detail.baep-depression-detail.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1883 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepDepressionDetail\\Http\\Controllers\\BaepDepressionDetailController@store',
    'permission' => 'medical-record-baep-depression-detail.baep-depression-detail.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1884 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepDysphagiaDetail\\Http\\Controllers\\BaepDysphagiaDetailController@index',
    'permission' => 'medical-record-baep-dysphagia-detail.baep-dysphagia-detail.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1885 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepDysphagiaDetail\\Http\\Controllers\\BaepDysphagiaDetailController@show',
    'permission' => 'medical-record-baep-dysphagia-detail.baep-dysphagia-detail.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1886 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepDysphagiaDetail\\Http\\Controllers\\BaepDysphagiaDetailController@store',
    'permission' => 'medical-record-baep-dysphagia-detail.baep-dysphagia-detail.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1887 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepInsomniaDetail\\Http\\Controllers\\BaepInsomniaDetailController@index',
    'permission' => 'medical-record-baep-insomnia-detail.baep-insomnia-detail.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1888 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepInsomniaDetail\\Http\\Controllers\\BaepInsomniaDetailController@show',
    'permission' => 'medical-record-baep-insomnia-detail.baep-insomnia-detail.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1889 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepInsomniaDetail\\Http\\Controllers\\BaepInsomniaDetailController@store',
    'permission' => 'medical-record-baep-insomnia-detail.baep-insomnia-detail.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1890 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepInterventionProtocol\\Http\\Controllers\\BaepInterventionProtocolController@index',
    'permission' => 'medical-record-baep-intervention-protocol.baep-intervention-protocol.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1891 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepInterventionProtocol\\Http\\Controllers\\BaepInterventionProtocolController@show',
    'permission' => 'medical-record-baep-intervention-protocol.baep-intervention-protocol.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1892 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepInterventionProtocol\\Http\\Controllers\\BaepInterventionProtocolController@store',
    'permission' => 'medical-record-baep-intervention-protocol.baep-intervention-protocol.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1893 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepInterventionProtocol\\Http\\Controllers\\BaepInterventionProtocolController@update',
    'permission' => 'medical-record-baep-intervention-protocol.baep-intervention-protocol.update',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1894 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepMotorDetail\\Http\\Controllers\\BaepMotorDetailController@index',
    'permission' => 'medical-record-baep-motor-detail.baep-motor-detail.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1895 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepMotorDetail\\Http\\Controllers\\BaepMotorDetailController@show',
    'permission' => 'medical-record-baep-motor-detail.baep-motor-detail.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1896 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepMotorDetail\\Http\\Controllers\\BaepMotorDetailController@store',
    'permission' => 'medical-record-baep-motor-detail.baep-motor-detail.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1897 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepSensoryDetail\\Http\\Controllers\\BaepSensoryDetailController@index',
    'permission' => 'medical-record-baep-sensory-detail.baep-sensory-detail.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1898 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepSensoryDetail\\Http\\Controllers\\BaepSensoryDetailController@show',
    'permission' => 'medical-record-baep-sensory-detail.baep-sensory-detail.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1899 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepSensoryDetail\\Http\\Controllers\\BaepSensoryDetailController@store',
    'permission' => 'medical-record-baep-sensory-detail.baep-sensory-detail.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1900 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepStimulationProtocolDetail\\Http\\Controllers\\BaepStimulationProtocolDetailController@index',
    'permission' => 'medical-record-baep-stimulation-protocol-detail.baep-stimulation-protocol-detail.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1901 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepStimulationProtocolDetail\\Http\\Controllers\\BaepStimulationProtocolDetailController@show',
    'permission' => 'medical-record-baep-stimulation-protocol-detail.baep-stimulation-protocol-detail.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1902 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBaepStimulationProtocolDetail\\Http\\Controllers\\BaepStimulationProtocolDetailController@store',
    'permission' => 'medical-record-baep-stimulation-protocol-detail.baep-stimulation-protocol-detail.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1903 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBarthelIndexAssessment\\Http\\Controllers\\BarthelIndexAssessmentController@index',
    'permission' => 'medical-record-barthel-index-assessment.barthel-index-assessment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1904 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBarthelIndexAssessment\\Http\\Controllers\\BarthelIndexAssessmentController@show',
    'permission' => 'medical-record-barthel-index-assessment.barthel-index-assessment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1905 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBarthelIndexAssessment\\Http\\Controllers\\BarthelIndexAssessmentController@store',
    'permission' => 'medical-record-barthel-index-assessment.barthel-index-assessment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1906 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBarthelIndexAssessment\\Http\\Controllers\\BarthelIndexAssessmentController@update',
    'permission' => 'medical-record-barthel-index-assessment.barthel-index-assessment.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1907 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBarthelIndexAssessment\\Http\\Controllers\\BarthelIndexAssessmentController@destroy',
    'permission' => 'medical-record-barthel-index-assessment.barthel-index-assessment.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1908 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBirthCertificateLetter\\Http\\Controllers\\BirthCertificateLetterController@index',
    'permission' => 'medical-record-birth-certificate-letter.birth-certificate-letter.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1909 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBirthCertificateLetter\\Http\\Controllers\\BirthCertificateLetterController@show',
    'permission' => 'medical-record-birth-certificate-letter.birth-certificate-letter.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1910 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBirthCertificateLetter\\Http\\Controllers\\BirthCertificateLetterController@store',
    'permission' => 'medical-record-birth-certificate-letter.birth-certificate-letter.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1911 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBirthCertificateLetter\\Http\\Controllers\\BirthCertificateLetterController@update',
    'permission' => 'medical-record-birth-certificate-letter.birth-certificate-letter.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1912 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBirthCertificateLetter\\Http\\Controllers\\BirthCertificateLetterController@destroy',
    'permission' => 'medical-record-birth-certificate-letter.birth-certificate-letter.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1913 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBloodTransfusion\\Http\\Controllers\\BloodTransfusionController@index',
    'permission' => 'medical-record-blood-transfusion.blood-transfusion.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1914 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBloodTransfusion\\Http\\Controllers\\BloodTransfusionController@show',
    'permission' => 'medical-record-blood-transfusion.blood-transfusion.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1915 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBloodTransfusion\\Http\\Controllers\\BloodTransfusionController@store',
    'permission' => 'medical-record-blood-transfusion.blood-transfusion.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1916 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBloodTransfusion\\Http\\Controllers\\BloodTransfusionController@update',
    'permission' => 'medical-record-blood-transfusion.blood-transfusion.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1917 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBloodTransfusionDetail\\Http\\Controllers\\BloodTransfusionDetailController@index',
    'permission' => 'medical-record-blood-transfusion-detail.blood-transfusion-detail.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1918 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBloodTransfusionDetail\\Http\\Controllers\\BloodTransfusionDetailController@show',
    'permission' => 'medical-record-blood-transfusion-detail.blood-transfusion-detail.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1919 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBloodTransfusionDetail\\Http\\Controllers\\BloodTransfusionDetailController@store',
    'permission' => 'medical-record-blood-transfusion-detail.blood-transfusion-detail.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1920 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBloodTransfusionDetail\\Http\\Controllers\\BloodTransfusionDetailController@update',
    'permission' => 'medical-record-blood-transfusion-detail.blood-transfusion-detail.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1921 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBloodTransfusionDetail\\Http\\Controllers\\BloodTransfusionDetailController@destroy',
    'permission' => 'medical-record-blood-transfusion-detail.blood-transfusion-detail.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1922 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBloodTransfusionObservation\\Http\\Controllers\\BloodTransfusionObservationController@index',
    'permission' => 'medical-record-blood-transfusion-observation.blood-transfusion-observation.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1923 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBloodTransfusionObservation\\Http\\Controllers\\BloodTransfusionObservationController@show',
    'permission' => 'medical-record-blood-transfusion-observation.blood-transfusion-observation.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1924 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBloodTransfusionObservation\\Http\\Controllers\\BloodTransfusionObservationController@store',
    'permission' => 'medical-record-blood-transfusion-observation.blood-transfusion-observation.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1925 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBloodTransfusionObservation\\Http\\Controllers\\BloodTransfusionObservationController@update',
    'permission' => 'medical-record-blood-transfusion-observation.blood-transfusion-observation.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1926 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBloodTransfusionObservation\\Http\\Controllers\\BloodTransfusionObservationController@destroy',
    'permission' => 'medical-record-blood-transfusion-observation.blood-transfusion-observation.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1927 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBreastExamination\\Http\\Controllers\\BreastExaminationController@index',
    'permission' => 'medical-record-breast-examination.breast-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1928 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBreastExamination\\Http\\Controllers\\BreastExaminationController@show',
    'permission' => 'medical-record-breast-examination.breast-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1929 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBreastExamination\\Http\\Controllers\\BreastExaminationController@store',
    'permission' => 'medical-record-breast-examination.breast-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1930 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBreastExamination\\Http\\Controllers\\BreastExaminationController@update',
    'permission' => 'medical-record-breast-examination.breast-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1931 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordBreastExamination\\Http\\Controllers\\BreastExaminationController@destroy',
    'permission' => 'medical-record-breast-examination.breast-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1932 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordCaseManagerAssessment\\Http\\Controllers\\CaseManagerAssessmentController@index',
    'permission' => 'medical-record-case-manager-assessment.case-manager-assessment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1933 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordCaseManagerAssessment\\Http\\Controllers\\CaseManagerAssessmentController@show',
    'permission' => 'medical-record-case-manager-assessment.case-manager-assessment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1934 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordCaseManagerAssessment\\Http\\Controllers\\CaseManagerAssessmentController@store',
    'permission' => 'medical-record-case-manager-assessment.case-manager-assessment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1935 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordCaseManagerAssessment\\Http\\Controllers\\CaseManagerAssessmentController@update',
    'permission' => 'medical-record-case-manager-assessment.case-manager-assessment.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1936 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordCaseManagerAssessment\\Http\\Controllers\\CaseManagerAssessmentController@destroy',
    'permission' => 'medical-record-case-manager-assessment.case-manager-assessment.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1937 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordCatClamsExamination\\Http\\Controllers\\CatClamsExaminationController@index',
    'permission' => 'medical-record-cat-clams-examination.cat-clams-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1938 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordCatClamsExamination\\Http\\Controllers\\CatClamsExaminationController@show',
    'permission' => 'medical-record-cat-clams-examination.cat-clams-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1939 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordCatClamsExamination\\Http\\Controllers\\CatClamsExaminationController@store',
    'permission' => 'medical-record-cat-clams-examination.cat-clams-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1940 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordCatClamsExamination\\Http\\Controllers\\CatClamsExaminationController@update',
    'permission' => 'medical-record-cat-clams-examination.cat-clams-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1941 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordCatClamsExamination\\Http\\Controllers\\CatClamsExaminationController@destroy',
    'permission' => 'medical-record-cat-clams-examination.cat-clams-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1942 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordChestExamination\\Http\\Controllers\\ChestExaminationController@index',
    'permission' => 'medical-record-chest-examination.chest-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1943 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordChestExamination\\Http\\Controllers\\ChestExaminationController@show',
    'permission' => 'medical-record-chest-examination.chest-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1944 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordChestExamination\\Http\\Controllers\\ChestExaminationController@store',
    'permission' => 'medical-record-chest-examination.chest-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1945 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordChestExamination\\Http\\Controllers\\ChestExaminationController@update',
    'permission' => 'medical-record-chest-examination.chest-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1946 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordChestExamination\\Http\\Controllers\\ChestExaminationController@destroy',
    'permission' => 'medical-record-chest-examination.chest-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1947 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordChiefComplaint\\Http\\Controllers\\ChiefComplaintController@index',
    'permission' => 'medical-record-chief-complaint.chief-complaint.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1948 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordChiefComplaint\\Http\\Controllers\\ChiefComplaintController@show',
    'permission' => 'medical-record-chief-complaint.chief-complaint.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1949 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordChiefComplaint\\Http\\Controllers\\ChiefComplaintController@store',
    'permission' => 'medical-record-chief-complaint.chief-complaint.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1950 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordChiefComplaint\\Http\\Controllers\\ChiefComplaintController@update',
    'permission' => 'medical-record-chief-complaint.chief-complaint.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1951 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordChiefComplaint\\Http\\Controllers\\ChiefComplaintController@destroy',
    'permission' => 'medical-record-chief-complaint.chief-complaint.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1952 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordClinicalNote\\Http\\Controllers\\ClinicalNoteController@index',
    'permission' => 'medical-record-clinical-note.clinical-note.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1953 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordClinicalNote\\Http\\Controllers\\ClinicalNoteController@show',
    'permission' => 'medical-record-clinical-note.clinical-note.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1954 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordClinicalNote\\Http\\Controllers\\ClinicalNoteController@store',
    'permission' => 'medical-record-clinical-note.clinical-note.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1955 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordClinicalNoteCoManagement\\Http\\Controllers\\ClinicalNoteCoManagementController@index',
    'permission' => 'medical-record-clinical-note-co-management.clinical-note-co-management.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1956 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordClinicalNoteCoManagement\\Http\\Controllers\\ClinicalNoteCoManagementController@show',
    'permission' => 'medical-record-clinical-note-co-management.clinical-note-co-management.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1957 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordClinicalNoteCoManagement\\Http\\Controllers\\ClinicalNoteCoManagementController@store',
    'permission' => 'medical-record-clinical-note-co-management.clinical-note-co-management.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1958 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordClinicalNoteCoManagement\\Http\\Controllers\\ClinicalNoteCoManagementController@update',
    'permission' => 'medical-record-clinical-note-co-management.clinical-note-co-management.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1959 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordClinicalNoteCoManagement\\Http\\Controllers\\ClinicalNoteCoManagementController@destroy',
    'permission' => 'medical-record-clinical-note-co-management.clinical-note-co-management.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1960 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordClinicalNoteVerification\\Http\\Controllers\\ClinicalNoteVerificationController@index',
    'permission' => 'medical-record-clinical-note-verification.clinical-note-verification.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1961 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordClinicalNoteVerification\\Http\\Controllers\\ClinicalNoteVerificationController@show',
    'permission' => 'medical-record-clinical-note-verification.clinical-note-verification.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1962 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordClinicalNoteVerification\\Http\\Controllers\\ClinicalNoteVerificationController@store',
    'permission' => 'medical-record-clinical-note-verification.clinical-note-verification.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1963 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordClinicalNoteVerification\\Http\\Controllers\\ClinicalNoteVerificationController@update',
    'permission' => 'medical-record-clinical-note-verification.clinical-note-verification.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1964 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordClinicalNoteVerification\\Http\\Controllers\\ClinicalNoteVerificationController@destroy',
    'permission' => 'medical-record-clinical-note-verification.clinical-note-verification.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1965 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordControlSchedule\\Http\\Controllers\\ControlScheduleController@index',
    'permission' => 'medical-record-control-schedule.control-schedule.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1966 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordControlSchedule\\Http\\Controllers\\ControlScheduleController@show',
    'permission' => 'medical-record-control-schedule.control-schedule.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1967 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordControlSchedule\\Http\\Controllers\\ControlScheduleController@store',
    'permission' => 'medical-record-control-schedule.control-schedule.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1968 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordControlSchedule\\Http\\Controllers\\ControlScheduleController@update',
    'permission' => 'medical-record-control-schedule.control-schedule.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1969 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordControlSchedule\\Http\\Controllers\\ControlScheduleController@destroy',
    'permission' => 'medical-record-control-schedule.control-schedule.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1970 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordCoughAssessment\\Http\\Controllers\\CoughAssessmentController@index',
    'permission' => 'medical-record-cough-assessment.cough-assessment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1971 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordCoughAssessment\\Http\\Controllers\\CoughAssessmentController@show',
    'permission' => 'medical-record-cough-assessment.cough-assessment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1972 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordCoughAssessment\\Http\\Controllers\\CoughAssessmentController@store',
    'permission' => 'medical-record-cough-assessment.cough-assessment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1973 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordCoughAssessment\\Http\\Controllers\\CoughAssessmentController@update',
    'permission' => 'medical-record-cough-assessment.cough-assessment.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1974 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordCoughAssessment\\Http\\Controllers\\CoughAssessmentController@destroy',
    'permission' => 'medical-record-cough-assessment.cough-assessment.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1975 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordCppt\\Http\\Controllers\\CpptEntryController@index',
    'permission' => 'medical-record-cppt.cppt-entry.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1976 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordCppt\\Http\\Controllers\\CpptEntryController@store',
    'permission' => 'medical-record-cppt.cppt-entry.store',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1977 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordCppt\\Http\\Controllers\\CpptEntryController@show',
    'permission' => 'medical-record-cppt.cppt-entry.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1978 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordCppt\\Http\\Controllers\\CpptVerificationController@index',
    'permission' => 'medical-record-cppt.cppt-verification.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1979 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordCppt\\Http\\Controllers\\CpptVerificationController@store',
    'permission' => 'medical-record-cppt.cppt-verification.store',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1980 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordCppt\\Http\\Controllers\\CpptVerificationController@show',
    'permission' => 'medical-record-cppt.cppt-verification.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1981 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDentalExamination\\Http\\Controllers\\DentalExaminationController@index',
    'permission' => 'medical-record-dental-examination.dental-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1982 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDentalExamination\\Http\\Controllers\\DentalExaminationController@show',
    'permission' => 'medical-record-dental-examination.dental-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1983 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDentalExamination\\Http\\Controllers\\DentalExaminationController@store',
    'permission' => 'medical-record-dental-examination.dental-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1984 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDentalExamination\\Http\\Controllers\\DentalExaminationController@update',
    'permission' => 'medical-record-dental-examination.dental-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1985 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDentalExamination\\Http\\Controllers\\DentalExaminationController@destroy',
    'permission' => 'medical-record-dental-examination.dental-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1986 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDiagnosis\\Http\\Controllers\\DiagnosisController@index',
    'permission' => 'medical-record-diagnosis.diagnosis.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1987 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDiagnosis\\Http\\Controllers\\DiagnosisController@show',
    'permission' => 'medical-record-diagnosis.diagnosis.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1988 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDiagnosis\\Http\\Controllers\\DiagnosisController@store',
    'permission' => 'medical-record-diagnosis.diagnosis.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1989 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDiagnosis\\Http\\Controllers\\DiagnosisController@destroy',
    'permission' => 'medical-record-diagnosis.diagnosis.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1990 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDiagnosisIndicatorMapping\\Http\\Controllers\\DiagnosisIndicatorMappingController@index',
    'permission' => 'medical-record-diagnosis-indicator-mapping.diagnosis-indicator-mapping.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1991 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDiagnosisIndicatorMapping\\Http\\Controllers\\DiagnosisIndicatorMappingController@show',
    'permission' => 'medical-record-diagnosis-indicator-mapping.diagnosis-indicator-mapping.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1992 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDiagnosisIndicatorMapping\\Http\\Controllers\\DiagnosisIndicatorMappingController@store',
    'permission' => 'medical-record-diagnosis-indicator-mapping.diagnosis-indicator-mapping.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1993 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDiagnosisIndicatorMapping\\Http\\Controllers\\DiagnosisIndicatorMappingController@update',
    'permission' => 'medical-record-diagnosis-indicator-mapping.diagnosis-indicator-mapping.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1994 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDiagnosisIndicatorMapping\\Http\\Controllers\\DiagnosisIndicatorMappingController@destroy',
    'permission' => 'medical-record-diagnosis-indicator-mapping.diagnosis-indicator-mapping.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1995 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDifferentialDiagnosis\\Http\\Controllers\\DifferentialDiagnosisController@index',
    'permission' => 'medical-record-differential-diagnosis.differential-diagnosis.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1996 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDifferentialDiagnosis\\Http\\Controllers\\DifferentialDiagnosisController@show',
    'permission' => 'medical-record-differential-diagnosis.differential-diagnosis.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  1997 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDifferentialDiagnosis\\Http\\Controllers\\DifferentialDiagnosisController@store',
    'permission' => 'medical-record-differential-diagnosis.differential-diagnosis.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1998 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDifferentialDiagnosis\\Http\\Controllers\\DifferentialDiagnosisController@update',
    'permission' => 'medical-record-differential-diagnosis.differential-diagnosis.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  1999 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDifferentialDiagnosis\\Http\\Controllers\\DifferentialDiagnosisController@destroy',
    'permission' => 'medical-record-differential-diagnosis.differential-diagnosis.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2000 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDischargeMedicationReconciliation\\Http\\Controllers\\DischargeMedicationReconciliationController@index',
    'permission' => 'medical-record-discharge-medication-reconciliation.discharge-medication-reconciliation.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2001 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDischargeMedicationReconciliation\\Http\\Controllers\\DischargeMedicationReconciliationController@show',
    'permission' => 'medical-record-discharge-medication-reconciliation.discharge-medication-reconciliation.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2002 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDischargeMedicationReconciliation\\Http\\Controllers\\DischargeMedicationReconciliationController@store',
    'permission' => 'medical-record-discharge-medication-reconciliation.discharge-medication-reconciliation.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2003 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDischargeMedicationReconciliation\\Http\\Controllers\\DischargeMedicationReconciliationController@update',
    'permission' => 'medical-record-discharge-medication-reconciliation.discharge-medication-reconciliation.update',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2004 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDischargeMedicationReconciliationItem\\Http\\Controllers\\DischargeMedicationReconciliationItemController@index',
    'permission' => 'medical-record-discharge-medication-reconciliation-item.discharge-medication-reconciliation-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2005 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDischargeMedicationReconciliationItem\\Http\\Controllers\\DischargeMedicationReconciliationItemController@show',
    'permission' => 'medical-record-discharge-medication-reconciliation-item.discharge-medication-reconciliation-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2006 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDischargeMedicationReconciliationItem\\Http\\Controllers\\DischargeMedicationReconciliationItemController@store',
    'permission' => 'medical-record-discharge-medication-reconciliation-item.discharge-medication-reconciliation-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2007 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDischargePlanningRiskFactor\\Http\\Controllers\\DischargePlanningRiskFactorController@index',
    'permission' => 'medical-record-discharge-planning-risk-factor.discharge-planning-risk-factor.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2008 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDischargePlanningRiskFactor\\Http\\Controllers\\DischargePlanningRiskFactorController@show',
    'permission' => 'medical-record-discharge-planning-risk-factor.discharge-planning-risk-factor.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2009 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDischargePlanningRiskFactor\\Http\\Controllers\\DischargePlanningRiskFactorController@store',
    'permission' => 'medical-record-discharge-planning-risk-factor.discharge-planning-risk-factor.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2010 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDischargePlanningRiskFactor\\Http\\Controllers\\DischargePlanningRiskFactorController@update',
    'permission' => 'medical-record-discharge-planning-risk-factor.discharge-planning-risk-factor.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2011 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDischargePlanningRiskFactor\\Http\\Controllers\\DischargePlanningRiskFactorController@destroy',
    'permission' => 'medical-record-discharge-planning-risk-factor.discharge-planning-risk-factor.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2012 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDischargePlanningScreening\\Http\\Controllers\\DischargePlanningScreeningController@index',
    'permission' => 'medical-record-discharge-planning-screening.discharge-planning-screening.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2013 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDischargePlanningScreening\\Http\\Controllers\\DischargePlanningScreeningController@show',
    'permission' => 'medical-record-discharge-planning-screening.discharge-planning-screening.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2014 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDischargePlanningScreening\\Http\\Controllers\\DischargePlanningScreeningController@store',
    'permission' => 'medical-record-discharge-planning-screening.discharge-planning-screening.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2015 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDischargePlanningScreening\\Http\\Controllers\\DischargePlanningScreeningController@update',
    'permission' => 'medical-record-discharge-planning-screening.discharge-planning-screening.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2016 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDischargePlanningScreening\\Http\\Controllers\\DischargePlanningScreeningController@destroy',
    'permission' => 'medical-record-discharge-planning-screening.discharge-planning-screening.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2017 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDischargeSummary\\Http\\Controllers\\DischargeSummaryController@index',
    'permission' => 'medical-record-discharge-summary.discharge-summary.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2018 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDischargeSummary\\Http\\Controllers\\DischargeSummaryController@show',
    'permission' => 'medical-record-discharge-summary.discharge-summary.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2019 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDischargeSummary\\Http\\Controllers\\DischargeSummaryController@store',
    'permission' => 'medical-record-discharge-summary.discharge-summary.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2020 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDoctorProcedureConsent\\Http\\Controllers\\DoctorProcedureConsentController@index',
    'permission' => 'medical-record-doctor-procedure-consent.doctor-procedure-consent.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2021 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDoctorProcedureConsent\\Http\\Controllers\\DoctorProcedureConsentController@show',
    'permission' => 'medical-record-doctor-procedure-consent.doctor-procedure-consent.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2022 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDoctorProcedureConsent\\Http\\Controllers\\DoctorProcedureConsentController@store',
    'permission' => 'medical-record-doctor-procedure-consent.doctor-procedure-consent.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2023 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDocumentUpload\\Http\\Controllers\\DocumentUploadController@index',
    'permission' => 'medical-record-document-upload.document-upload.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2024 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDocumentUpload\\Http\\Controllers\\DocumentUploadController@show',
    'permission' => 'medical-record-document-upload.document-upload.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2025 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDocumentUpload\\Http\\Controllers\\DocumentUploadController@store',
    'permission' => 'medical-record-document-upload.document-upload.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2026 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDocumentUpload\\Http\\Controllers\\DocumentUploadController@update',
    'permission' => 'medical-record-document-upload.document-upload.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2027 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordDocumentUpload\\Http\\Controllers\\DocumentUploadController@destroy',
    'permission' => 'medical-record-document-upload.document-upload.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2028 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEarExamination\\Http\\Controllers\\EarExaminationController@index',
    'permission' => 'medical-record-ear-examination.ear-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2029 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEarExamination\\Http\\Controllers\\EarExaminationController@show',
    'permission' => 'medical-record-ear-examination.ear-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2030 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEarExamination\\Http\\Controllers\\EarExaminationController@store',
    'permission' => 'medical-record-ear-examination.ear-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2031 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEarExamination\\Http\\Controllers\\EarExaminationController@update',
    'permission' => 'medical-record-ear-examination.ear-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2032 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEarExamination\\Http\\Controllers\\EarExaminationController@destroy',
    'permission' => 'medical-record-ear-examination.ear-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2033 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEegExamination\\Http\\Controllers\\EegExaminationController@index',
    'permission' => 'medical-record-eeg-examination.eeg-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2034 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEegExamination\\Http\\Controllers\\EegExaminationController@show',
    'permission' => 'medical-record-eeg-examination.eeg-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2035 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEegExamination\\Http\\Controllers\\EegExaminationController@store',
    'permission' => 'medical-record-eeg-examination.eeg-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2036 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEegExamination\\Http\\Controllers\\EegExaminationController@update',
    'permission' => 'medical-record-eeg-examination.eeg-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2037 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEegExamination\\Http\\Controllers\\EegExaminationController@destroy',
    'permission' => 'medical-record-eeg-examination.eeg-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2038 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEkgExamination\\Http\\Controllers\\EkgExaminationController@index',
    'permission' => 'medical-record-ekg-examination.ekg-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2039 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEkgExamination\\Http\\Controllers\\EkgExaminationController@show',
    'permission' => 'medical-record-ekg-examination.ekg-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2040 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEkgExamination\\Http\\Controllers\\EkgExaminationController@store',
    'permission' => 'medical-record-ekg-examination.ekg-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2041 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEkgExamination\\Http\\Controllers\\EkgExaminationController@update',
    'permission' => 'medical-record-ekg-examination.ekg-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2042 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEkgExamination\\Http\\Controllers\\EkgExaminationController@destroy',
    'permission' => 'medical-record-ekg-examination.ekg-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2043 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEmergencyEducation\\Http\\Controllers\\EmergencyEducationController@index',
    'permission' => 'medical-record-emergency-education.emergency-education.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2044 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEmergencyEducation\\Http\\Controllers\\EmergencyEducationController@show',
    'permission' => 'medical-record-emergency-education.emergency-education.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2045 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEmergencyEducation\\Http\\Controllers\\EmergencyEducationController@store',
    'permission' => 'medical-record-emergency-education.emergency-education.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2046 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEmergencyEducation\\Http\\Controllers\\EmergencyEducationController@update',
    'permission' => 'medical-record-emergency-education.emergency-education.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2047 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEmergencyEducation\\Http\\Controllers\\EmergencyEducationController@destroy',
    'permission' => 'medical-record-emergency-education.emergency-education.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2048 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEmgExamination\\Http\\Controllers\\EmgExaminationController@index',
    'permission' => 'medical-record-emg-examination.emg-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2049 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEmgExamination\\Http\\Controllers\\EmgExaminationController@show',
    'permission' => 'medical-record-emg-examination.emg-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2050 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEmgExamination\\Http\\Controllers\\EmgExaminationController@store',
    'permission' => 'medical-record-emg-examination.emg-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2051 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEmgExamination\\Http\\Controllers\\EmgExaminationController@update',
    'permission' => 'medical-record-emg-examination.emg-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2052 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEmgExamination\\Http\\Controllers\\EmgExaminationController@destroy',
    'permission' => 'medical-record-emg-examination.emg-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2053 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEndOfLifeEducation\\Http\\Controllers\\EndOfLifeEducationController@index',
    'permission' => 'medical-record-end-of-life-education.end-of-life-education.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2054 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEndOfLifeEducation\\Http\\Controllers\\EndOfLifeEducationController@show',
    'permission' => 'medical-record-end-of-life-education.end-of-life-education.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2055 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEndOfLifeEducation\\Http\\Controllers\\EndOfLifeEducationController@store',
    'permission' => 'medical-record-end-of-life-education.end-of-life-education.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2056 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEndOfLifeEducation\\Http\\Controllers\\EndOfLifeEducationController@update',
    'permission' => 'medical-record-end-of-life-education.end-of-life-education.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2057 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEndOfLifeEducation\\Http\\Controllers\\EndOfLifeEducationController@destroy',
    'permission' => 'medical-record-end-of-life-education.end-of-life-education.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2058 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEndOfLifePsychosocialRelationship\\Http\\Controllers\\EndOfLifePsychosocialRelationshipController@index',
    'permission' => 'medical-record-end-of-life-psychosocial-relationship.end-of-life-psychosocial-relationship.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2059 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEndOfLifePsychosocialRelationship\\Http\\Controllers\\EndOfLifePsychosocialRelationshipController@show',
    'permission' => 'medical-record-end-of-life-psychosocial-relationship.end-of-life-psychosocial-relationship.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2060 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEndOfLifePsychosocialRelationship\\Http\\Controllers\\EndOfLifePsychosocialRelationshipController@store',
    'permission' => 'medical-record-end-of-life-psychosocial-relationship.end-of-life-psychosocial-relationship.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2061 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEndOfLifePsychosocialRelationship\\Http\\Controllers\\EndOfLifePsychosocialRelationshipController@update',
    'permission' => 'medical-record-end-of-life-psychosocial-relationship.end-of-life-psychosocial-relationship.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2062 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEndOfLifePsychosocialRelationship\\Http\\Controllers\\EndOfLifePsychosocialRelationshipController@destroy',
    'permission' => 'medical-record-end-of-life-psychosocial-relationship.end-of-life-psychosocial-relationship.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2063 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEpfraAssessment\\Http\\Controllers\\EpfraAssessmentController@index',
    'permission' => 'medical-record-epfra-assessment.epfra-assessment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2064 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEpfraAssessment\\Http\\Controllers\\EpfraAssessmentController@show',
    'permission' => 'medical-record-epfra-assessment.epfra-assessment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2065 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEpfraAssessment\\Http\\Controllers\\EpfraAssessmentController@store',
    'permission' => 'medical-record-epfra-assessment.epfra-assessment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2066 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEpfraAssessment\\Http\\Controllers\\EpfraAssessmentController@update',
    'permission' => 'medical-record-epfra-assessment.epfra-assessment.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2067 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEpfraAssessment\\Http\\Controllers\\EpfraAssessmentController@destroy',
    'permission' => 'medical-record-epfra-assessment.epfra-assessment.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2068 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEpisode\\Http\\Controllers\\MedicalRecordEpisodeController@show',
    'permission' => 'medical-record-episode.medical-record-episode.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2069 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEpisode\\Http\\Controllers\\MedicalRecordEpisodeController@start',
    'permission' => 'medical-record-episode.medical-record-episode.start',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2070 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEpisode\\Http\\Controllers\\MedicalRecordEpisodeController@finalize',
    'permission' => 'medical-record-episode.medical-record-episode.finalize',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2071 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEpisode\\Http\\Controllers\\MedicalRecordEpisodeController@amend',
    'permission' => 'medical-record-episode.medical-record-episode.amend',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2072 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordExaminationType\\Http\\Controllers\\ExaminationTypeController@index',
    'permission' => 'medical-record-examination-type.examination-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2073 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordExaminationType\\Http\\Controllers\\ExaminationTypeController@show',
    'permission' => 'medical-record-examination-type.examination-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2074 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordExaminationType\\Http\\Controllers\\ExaminationTypeController@store',
    'permission' => 'medical-record-examination-type.examination-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2075 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordExaminationType\\Http\\Controllers\\ExaminationTypeController@update',
    'permission' => 'medical-record-examination-type.examination-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2076 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordExaminationType\\Http\\Controllers\\ExaminationTypeController@destroy',
    'permission' => 'medical-record-examination-type.examination-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2077 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordExternalRiskFactor\\Http\\Controllers\\ExternalRiskFactorController@index',
    'permission' => 'medical-record-external-risk-factor.external-risk-factor.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2078 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordExternalRiskFactor\\Http\\Controllers\\ExternalRiskFactorController@show',
    'permission' => 'medical-record-external-risk-factor.external-risk-factor.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2079 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordExternalRiskFactor\\Http\\Controllers\\ExternalRiskFactorController@store',
    'permission' => 'medical-record-external-risk-factor.external-risk-factor.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2080 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordExternalRiskFactor\\Http\\Controllers\\ExternalRiskFactorController@update',
    'permission' => 'medical-record-external-risk-factor.external-risk-factor.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2081 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordExternalRiskFactor\\Http\\Controllers\\ExternalRiskFactorController@destroy',
    'permission' => 'medical-record-external-risk-factor.external-risk-factor.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2082 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEyeExamDocumentUpload\\Http\\Controllers\\EyeExamDocumentUploadController@index',
    'permission' => 'medical-record-eye-exam-document-upload.eye-exam-document-upload.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2083 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEyeExamDocumentUpload\\Http\\Controllers\\EyeExamDocumentUploadController@show',
    'permission' => 'medical-record-eye-exam-document-upload.eye-exam-document-upload.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2084 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEyeExamDocumentUpload\\Http\\Controllers\\EyeExamDocumentUploadController@store',
    'permission' => 'medical-record-eye-exam-document-upload.eye-exam-document-upload.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2085 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEyeExamDocumentUpload\\Http\\Controllers\\EyeExamDocumentUploadController@update',
    'permission' => 'medical-record-eye-exam-document-upload.eye-exam-document-upload.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2086 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEyeExamDocumentUpload\\Http\\Controllers\\EyeExamDocumentUploadController@destroy',
    'permission' => 'medical-record-eye-exam-document-upload.eye-exam-document-upload.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2087 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEyeExamination\\Http\\Controllers\\EyeExaminationController@index',
    'permission' => 'medical-record-eye-examination.eye-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2088 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEyeExamination\\Http\\Controllers\\EyeExaminationController@show',
    'permission' => 'medical-record-eye-examination.eye-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2089 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEyeExamination\\Http\\Controllers\\EyeExaminationController@store',
    'permission' => 'medical-record-eye-examination.eye-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2090 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEyeExamination\\Http\\Controllers\\EyeExaminationController@update',
    'permission' => 'medical-record-eye-examination.eye-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2091 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordEyeExamination\\Http\\Controllers\\EyeExaminationController@destroy',
    'permission' => 'medical-record-eye-examination.eye-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2092 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFamilyMedicalHistory\\Http\\Controllers\\FamilyMedicalHistoryController@index',
    'permission' => 'medical-record-family-medical-history.family-medical-history.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2093 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFamilyMedicalHistory\\Http\\Controllers\\FamilyMedicalHistoryController@show',
    'permission' => 'medical-record-family-medical-history.family-medical-history.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2094 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFamilyMedicalHistory\\Http\\Controllers\\FamilyMedicalHistoryController@store',
    'permission' => 'medical-record-family-medical-history.family-medical-history.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2095 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFamilyPlanningObstetrics\\Http\\Controllers\\FamilyPlanningObstetricsController@index',
    'permission' => 'medical-record-family-planning-obstetrics.family-planning-obstetrics.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2096 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFamilyPlanningObstetrics\\Http\\Controllers\\FamilyPlanningObstetricsController@show',
    'permission' => 'medical-record-family-planning-obstetrics.family-planning-obstetrics.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2097 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFamilyPlanningObstetrics\\Http\\Controllers\\FamilyPlanningObstetricsController@store',
    'permission' => 'medical-record-family-planning-obstetrics.family-planning-obstetrics.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2098 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFamilyPlanningObstetrics\\Http\\Controllers\\FamilyPlanningObstetricsController@update',
    'permission' => 'medical-record-family-planning-obstetrics.family-planning-obstetrics.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2099 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFamilyPlanningObstetrics\\Http\\Controllers\\FamilyPlanningObstetricsController@destroy',
    'permission' => 'medical-record-family-planning-obstetrics.family-planning-obstetrics.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2100 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFibroscanResult\\Http\\Controllers\\FibroscanResultController@index',
    'permission' => 'medical-record-fibroscan-result.fibroscan-result.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2101 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFibroscanResult\\Http\\Controllers\\FibroscanResultController@show',
    'permission' => 'medical-record-fibroscan-result.fibroscan-result.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2102 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFibroscanResult\\Http\\Controllers\\FibroscanResultController@store',
    'permission' => 'medical-record-fibroscan-result.fibroscan-result.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2103 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFibroscanResult\\Http\\Controllers\\FibroscanResultController@update',
    'permission' => 'medical-record-fibroscan-result.fibroscan-result.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2104 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFibroscanResult\\Http\\Controllers\\FibroscanResultController@destroy',
    'permission' => 'medical-record-fibroscan-result.fibroscan-result.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2105 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFingerExamination\\Http\\Controllers\\FingerExaminationController@index',
    'permission' => 'medical-record-finger-examination.finger-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2106 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFingerExamination\\Http\\Controllers\\FingerExaminationController@show',
    'permission' => 'medical-record-finger-examination.finger-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2107 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFingerExamination\\Http\\Controllers\\FingerExaminationController@store',
    'permission' => 'medical-record-finger-examination.finger-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2108 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFingerExamination\\Http\\Controllers\\FingerExaminationController@update',
    'permission' => 'medical-record-finger-examination.finger-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2109 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFingerExamination\\Http\\Controllers\\FingerExaminationController@destroy',
    'permission' => 'medical-record-finger-examination.finger-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2110 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFingernailExamination\\Http\\Controllers\\FingernailExaminationController@index',
    'permission' => 'medical-record-fingernail-examination.fingernail-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2111 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFingernailExamination\\Http\\Controllers\\FingernailExaminationController@show',
    'permission' => 'medical-record-fingernail-examination.fingernail-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2112 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFingernailExamination\\Http\\Controllers\\FingernailExaminationController@store',
    'permission' => 'medical-record-fingernail-examination.fingernail-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2113 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFingernailExamination\\Http\\Controllers\\FingernailExaminationController@update',
    'permission' => 'medical-record-fingernail-examination.fingernail-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2114 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFingernailExamination\\Http\\Controllers\\FingernailExaminationController@destroy',
    'permission' => 'medical-record-fingernail-examination.fingernail-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2115 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFluidBalanceAssessment\\Http\\Controllers\\FluidBalanceAssessmentController@index',
    'permission' => 'medical-record-fluid-balance-assessment.fluid-balance-assessment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2116 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFluidBalanceAssessment\\Http\\Controllers\\FluidBalanceAssessmentController@show',
    'permission' => 'medical-record-fluid-balance-assessment.fluid-balance-assessment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2117 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFluidBalanceAssessment\\Http\\Controllers\\FluidBalanceAssessmentController@store',
    'permission' => 'medical-record-fluid-balance-assessment.fluid-balance-assessment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2118 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFluidBalanceAssessment\\Http\\Controllers\\FluidBalanceAssessmentController@update',
    'permission' => 'medical-record-fluid-balance-assessment.fluid-balance-assessment.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2119 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFluidBalanceAssessment\\Http\\Controllers\\FluidBalanceAssessmentController@destroy',
    'permission' => 'medical-record-fluid-balance-assessment.fluid-balance-assessment.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2120 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFluidBalanceAssessmentDetail\\Http\\Controllers\\FluidBalanceAssessmentDetailController@index',
    'permission' => 'medical-record-fluid-balance-assessment-detail.fluid-balance-assessment-detail.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2121 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFluidBalanceAssessmentDetail\\Http\\Controllers\\FluidBalanceAssessmentDetailController@show',
    'permission' => 'medical-record-fluid-balance-assessment-detail.fluid-balance-assessment-detail.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2122 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFluidBalanceAssessmentDetail\\Http\\Controllers\\FluidBalanceAssessmentDetailController@store',
    'permission' => 'medical-record-fluid-balance-assessment-detail.fluid-balance-assessment-detail.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2123 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFluidBalanceAssessmentDetail\\Http\\Controllers\\FluidBalanceAssessmentDetailController@update',
    'permission' => 'medical-record-fluid-balance-assessment-detail.fluid-balance-assessment-detail.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2124 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFluidBalanceAssessmentDetail\\Http\\Controllers\\FluidBalanceAssessmentDetailController@destroy',
    'permission' => 'medical-record-fluid-balance-assessment-detail.fluid-balance-assessment-detail.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2125 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFluidFinalBalance\\Http\\Controllers\\FluidFinalBalanceController@index',
    'permission' => 'medical-record-fluid-final-balance.fluid-final-balance.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2126 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFluidFinalBalance\\Http\\Controllers\\FluidFinalBalanceController@show',
    'permission' => 'medical-record-fluid-final-balance.fluid-final-balance.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2127 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFluidFinalBalance\\Http\\Controllers\\FluidFinalBalanceController@store',
    'permission' => 'medical-record-fluid-final-balance.fluid-final-balance.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2128 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFluidFinalBalance\\Http\\Controllers\\FluidFinalBalanceController@update',
    'permission' => 'medical-record-fluid-final-balance.fluid-final-balance.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2129 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFluidFinalBalance\\Http\\Controllers\\FluidFinalBalanceController@destroy',
    'permission' => 'medical-record-fluid-final-balance.fluid-final-balance.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2130 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFoodAllergenExamination\\Http\\Controllers\\FoodAllergenExaminationController@index',
    'permission' => 'medical-record-food-allergen-examination.food-allergen-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2131 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFoodAllergenExamination\\Http\\Controllers\\FoodAllergenExaminationController@show',
    'permission' => 'medical-record-food-allergen-examination.food-allergen-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2132 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFoodAllergenExamination\\Http\\Controllers\\FoodAllergenExaminationController@store',
    'permission' => 'medical-record-food-allergen-examination.food-allergen-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2133 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFoodAllergenExamination\\Http\\Controllers\\FoodAllergenExaminationController@update',
    'permission' => 'medical-record-food-allergen-examination.food-allergen-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2134 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFoodAllergenExamination\\Http\\Controllers\\FoodAllergenExaminationController@destroy',
    'permission' => 'medical-record-food-allergen-examination.food-allergen-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2135 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordForearmExamination\\Http\\Controllers\\ForearmExaminationController@index',
    'permission' => 'medical-record-forearm-examination.forearm-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2136 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordForearmExamination\\Http\\Controllers\\ForearmExaminationController@show',
    'permission' => 'medical-record-forearm-examination.forearm-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2137 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordForearmExamination\\Http\\Controllers\\ForearmExaminationController@store',
    'permission' => 'medical-record-forearm-examination.forearm-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2138 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordForearmExamination\\Http\\Controllers\\ForearmExaminationController@update',
    'permission' => 'medical-record-forearm-examination.forearm-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2139 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordForearmExamination\\Http\\Controllers\\ForearmExaminationController@destroy',
    'permission' => 'medical-record-forearm-examination.forearm-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2140 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFunctionalAssessment\\Http\\Controllers\\FunctionalAssessmentController@index',
    'permission' => 'medical-record-functional-assessment.functional-assessment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2141 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFunctionalAssessment\\Http\\Controllers\\FunctionalAssessmentController@show',
    'permission' => 'medical-record-functional-assessment.functional-assessment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2142 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFunctionalAssessment\\Http\\Controllers\\FunctionalAssessmentController@store',
    'permission' => 'medical-record-functional-assessment.functional-assessment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2143 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFunctionalAssessment\\Http\\Controllers\\FunctionalAssessmentController@update',
    'permission' => 'medical-record-functional-assessment.functional-assessment.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2144 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFunctionalAssessment\\Http\\Controllers\\FunctionalAssessmentController@destroy',
    'permission' => 'medical-record-functional-assessment.functional-assessment.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2145 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFunctionalStatusAssessment\\Http\\Controllers\\FunctionalStatusAssessmentController@index',
    'permission' => 'medical-record-functional-status-assessment.functional-status-assessment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2146 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFunctionalStatusAssessment\\Http\\Controllers\\FunctionalStatusAssessmentController@show',
    'permission' => 'medical-record-functional-status-assessment.functional-status-assessment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2147 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordFunctionalStatusAssessment\\Http\\Controllers\\FunctionalStatusAssessmentController@store',
    'permission' => 'medical-record-functional-status-assessment.functional-status-assessment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2148 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGeneralExamination\\Http\\Controllers\\GeneralExaminationController@index',
    'permission' => 'medical-record-general-examination.general-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2149 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGeneralExamination\\Http\\Controllers\\GeneralExaminationController@show',
    'permission' => 'medical-record-general-examination.general-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2150 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGeneralExamination\\Http\\Controllers\\GeneralExaminationController@store',
    'permission' => 'medical-record-general-examination.general-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2151 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGeneralExamination\\Http\\Controllers\\GeneralExaminationController@update',
    'permission' => 'medical-record-general-examination.general-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2152 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGeneralExamination\\Http\\Controllers\\GeneralExaminationController@destroy',
    'permission' => 'medical-record-general-examination.general-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2153 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGenitalExamination\\Http\\Controllers\\GenitalExaminationController@index',
    'permission' => 'medical-record-genital-examination.genital-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2154 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGenitalExamination\\Http\\Controllers\\GenitalExaminationController@show',
    'permission' => 'medical-record-genital-examination.genital-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2155 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGenitalExamination\\Http\\Controllers\\GenitalExaminationController@store',
    'permission' => 'medical-record-genital-examination.genital-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2156 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGenitalExamination\\Http\\Controllers\\GenitalExaminationController@update',
    'permission' => 'medical-record-genital-examination.genital-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2157 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGenitalExamination\\Http\\Controllers\\GenitalExaminationController@destroy',
    'permission' => 'medical-record-genital-examination.genital-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2158 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGetUpAndGoTestAssessment\\Http\\Controllers\\GetUpAndGoTestAssessmentController@index',
    'permission' => 'medical-record-get-up-and-go-test-assessment.get-up-and-go-test-assessment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2159 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGetUpAndGoTestAssessment\\Http\\Controllers\\GetUpAndGoTestAssessmentController@show',
    'permission' => 'medical-record-get-up-and-go-test-assessment.get-up-and-go-test-assessment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2160 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGetUpAndGoTestAssessment\\Http\\Controllers\\GetUpAndGoTestAssessmentController@store',
    'permission' => 'medical-record-get-up-and-go-test-assessment.get-up-and-go-test-assessment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2161 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGetUpAndGoTestAssessment\\Http\\Controllers\\GetUpAndGoTestAssessmentController@update',
    'permission' => 'medical-record-get-up-and-go-test-assessment.get-up-and-go-test-assessment.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2162 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGetUpAndGoTestAssessment\\Http\\Controllers\\GetUpAndGoTestAssessmentController@destroy',
    'permission' => 'medical-record-get-up-and-go-test-assessment.get-up-and-go-test-assessment.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2163 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGraceRiskScoreAssessment\\Http\\Controllers\\GraceRiskScoreAssessmentController@index',
    'permission' => 'medical-record-grace-risk-score-assessment.grace-risk-score-assessment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2164 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGraceRiskScoreAssessment\\Http\\Controllers\\GraceRiskScoreAssessmentController@show',
    'permission' => 'medical-record-grace-risk-score-assessment.grace-risk-score-assessment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2165 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGraceRiskScoreAssessment\\Http\\Controllers\\GraceRiskScoreAssessmentController@store',
    'permission' => 'medical-record-grace-risk-score-assessment.grace-risk-score-assessment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2166 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGraceRiskScoreAssessment\\Http\\Controllers\\GraceRiskScoreAssessmentController@update',
    'permission' => 'medical-record-grace-risk-score-assessment.grace-risk-score-assessment.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2167 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGraceRiskScoreAssessment\\Http\\Controllers\\GraceRiskScoreAssessmentController@destroy',
    'permission' => 'medical-record-grace-risk-score-assessment.grace-risk-score-assessment.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2168 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGynecologyHistory\\Http\\Controllers\\GynecologyHistoryController@index',
    'permission' => 'medical-record-gynecology-history.gynecology-history.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2169 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGynecologyHistory\\Http\\Controllers\\GynecologyHistoryController@show',
    'permission' => 'medical-record-gynecology-history.gynecology-history.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2170 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGynecologyHistory\\Http\\Controllers\\GynecologyHistoryController@store',
    'permission' => 'medical-record-gynecology-history.gynecology-history.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2171 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGynecologyUltrasound\\Http\\Controllers\\GynecologyUltrasoundController@index',
    'permission' => 'medical-record-gynecology-ultrasound.gynecology-ultrasound.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2172 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGynecologyUltrasound\\Http\\Controllers\\GynecologyUltrasoundController@show',
    'permission' => 'medical-record-gynecology-ultrasound.gynecology-ultrasound.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2173 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGynecologyUltrasound\\Http\\Controllers\\GynecologyUltrasoundController@store',
    'permission' => 'medical-record-gynecology-ultrasound.gynecology-ultrasound.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2174 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGynecologyUltrasound\\Http\\Controllers\\GynecologyUltrasoundController@update',
    'permission' => 'medical-record-gynecology-ultrasound.gynecology-ultrasound.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2175 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordGynecologyUltrasound\\Http\\Controllers\\GynecologyUltrasoundController@destroy',
    'permission' => 'medical-record-gynecology-ultrasound.gynecology-ultrasound.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2176 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHairExamination\\Http\\Controllers\\HairExaminationController@index',
    'permission' => 'medical-record-hair-examination.hair-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2177 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHairExamination\\Http\\Controllers\\HairExaminationController@show',
    'permission' => 'medical-record-hair-examination.hair-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2178 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHairExamination\\Http\\Controllers\\HairExaminationController@store',
    'permission' => 'medical-record-hair-examination.hair-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2179 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHairExamination\\Http\\Controllers\\HairExaminationController@update',
    'permission' => 'medical-record-hair-examination.hair-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2180 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHairExamination\\Http\\Controllers\\HairExaminationController@destroy',
    'permission' => 'medical-record-hair-examination.hair-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2181 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHandJointExamination\\Http\\Controllers\\HandJointExaminationController@index',
    'permission' => 'medical-record-hand-joint-examination.hand-joint-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2182 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHandJointExamination\\Http\\Controllers\\HandJointExaminationController@show',
    'permission' => 'medical-record-hand-joint-examination.hand-joint-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2183 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHandJointExamination\\Http\\Controllers\\HandJointExaminationController@store',
    'permission' => 'medical-record-hand-joint-examination.hand-joint-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2184 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHandJointExamination\\Http\\Controllers\\HandJointExaminationController@update',
    'permission' => 'medical-record-hand-joint-examination.hand-joint-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2185 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHandJointExamination\\Http\\Controllers\\HandJointExaminationController@destroy',
    'permission' => 'medical-record-hand-joint-examination.hand-joint-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2186 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHeadExamination\\Http\\Controllers\\HeadExaminationController@index',
    'permission' => 'medical-record-head-examination.head-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2187 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHeadExamination\\Http\\Controllers\\HeadExaminationController@show',
    'permission' => 'medical-record-head-examination.head-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2188 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHeadExamination\\Http\\Controllers\\HeadExaminationController@store',
    'permission' => 'medical-record-head-examination.head-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2189 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHeadExamination\\Http\\Controllers\\HeadExaminationController@update',
    'permission' => 'medical-record-head-examination.head-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2190 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHeadExamination\\Http\\Controllers\\HeadExaminationController@destroy',
    'permission' => 'medical-record-head-examination.head-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2191 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHealthCertificate\\Http\\Controllers\\HealthCertificateController@index',
    'permission' => 'medical-record-health-certificate.health-certificate.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2192 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHealthCertificate\\Http\\Controllers\\HealthCertificateController@show',
    'permission' => 'medical-record-health-certificate.health-certificate.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2193 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHealthCertificate\\Http\\Controllers\\HealthCertificateController@store',
    'permission' => 'medical-record-health-certificate.health-certificate.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2194 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHealthCertificate\\Http\\Controllers\\HealthCertificateController@update',
    'permission' => 'medical-record-health-certificate.health-certificate.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2195 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHealthCertificate\\Http\\Controllers\\HealthCertificateController@destroy',
    'permission' => 'medical-record-health-certificate.health-certificate.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2196 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHemodialysisLetter\\Http\\Controllers\\HemodialysisLetterController@index',
    'permission' => 'medical-record-hemodialysis-letter.hemodialysis-letter.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2197 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHemodialysisLetter\\Http\\Controllers\\HemodialysisLetterController@show',
    'permission' => 'medical-record-hemodialysis-letter.hemodialysis-letter.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2198 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHemodialysisLetter\\Http\\Controllers\\HemodialysisLetterController@store',
    'permission' => 'medical-record-hemodialysis-letter.hemodialysis-letter.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2199 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHemodialysisLetter\\Http\\Controllers\\HemodialysisLetterController@update',
    'permission' => 'medical-record-hemodialysis-letter.hemodialysis-letter.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2200 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHemodialysisLetter\\Http\\Controllers\\HemodialysisLetterController@destroy',
    'permission' => 'medical-record-hemodialysis-letter.hemodialysis-letter.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2201 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHospitalizationCertificate\\Http\\Controllers\\HospitalizationCertificateController@index',
    'permission' => 'medical-record-hospitalization-certificate.hospitalization-certificate.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2202 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHospitalizationCertificate\\Http\\Controllers\\HospitalizationCertificateController@show',
    'permission' => 'medical-record-hospitalization-certificate.hospitalization-certificate.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2203 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHospitalizationCertificate\\Http\\Controllers\\HospitalizationCertificateController@store',
    'permission' => 'medical-record-hospitalization-certificate.hospitalization-certificate.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2204 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHospitalizationCertificate\\Http\\Controllers\\HospitalizationCertificateController@update',
    'permission' => 'medical-record-hospitalization-certificate.hospitalization-certificate.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2205 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHospitalizationCertificate\\Http\\Controllers\\HospitalizationCertificateController@destroy',
    'permission' => 'medical-record-hospitalization-certificate.hospitalization-certificate.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2206 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHumptyDumptyFallScaleAssessment\\Http\\Controllers\\HumptyDumptyFallScaleAssessmentController@index',
    'permission' => 'medical-record-humpty-dumpty-fall-scale-assessment.humpty-dumpty-fall-scale-assessment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2207 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHumptyDumptyFallScaleAssessment\\Http\\Controllers\\HumptyDumptyFallScaleAssessmentController@show',
    'permission' => 'medical-record-humpty-dumpty-fall-scale-assessment.humpty-dumpty-fall-scale-assessment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2208 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordHumptyDumptyFallScaleAssessment\\Http\\Controllers\\HumptyDumptyFallScaleAssessmentController@store',
    'permission' => 'medical-record-humpty-dumpty-fall-scale-assessment.humpty-dumpty-fall-scale-assessment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2209 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIcd10CauseOfDeathCode\\Http\\Controllers\\Icd10CauseOfDeathCodeController@index',
    'permission' => 'medical-record-icd10-cause-of-death-code.icd10-cause-of-death-code.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2210 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIcd10CauseOfDeathCode\\Http\\Controllers\\Icd10CauseOfDeathCodeController@show',
    'permission' => 'medical-record-icd10-cause-of-death-code.icd10-cause-of-death-code.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2211 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIcd10CauseOfDeathCode\\Http\\Controllers\\Icd10CauseOfDeathCodeController@store',
    'permission' => 'medical-record-icd10-cause-of-death-code.icd10-cause-of-death-code.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2212 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIcd10CauseOfDeathCode\\Http\\Controllers\\Icd10CauseOfDeathCodeController@update',
    'permission' => 'medical-record-icd10-cause-of-death-code.icd10-cause-of-death-code.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2213 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIcd10CauseOfDeathCode\\Http\\Controllers\\Icd10CauseOfDeathCodeController@destroy',
    'permission' => 'medical-record-icd10-cause-of-death-code.icd10-cause-of-death-code.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2214 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIcd10Code\\Http\\Controllers\\Icd10CodeController@index',
    'permission' => 'medical-record-icd10-code.icd10-code.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2215 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIcd10Code\\Http\\Controllers\\Icd10CodeController@show',
    'permission' => 'medical-record-icd10-code.icd10-code.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2216 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIcd10Code\\Http\\Controllers\\Icd10CodeController@store',
    'permission' => 'medical-record-icd10-code.icd10-code.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2217 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIcd10Code\\Http\\Controllers\\Icd10CodeController@update',
    'permission' => 'medical-record-icd10-code.icd10-code.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2218 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIcd10Code\\Http\\Controllers\\Icd10CodeController@destroy',
    'permission' => 'medical-record-icd10-code.icd10-code.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2219 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIcd9CmCode\\Http\\Controllers\\Icd9CmCodeController@index',
    'permission' => 'medical-record-icd9-cm-code.icd9-cm-code.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2220 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIcd9CmCode\\Http\\Controllers\\Icd9CmCodeController@show',
    'permission' => 'medical-record-icd9-cm-code.icd9-cm-code.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2221 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIcd9CmCode\\Http\\Controllers\\Icd9CmCodeController@store',
    'permission' => 'medical-record-icd9-cm-code.icd9-cm-code.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2222 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIcd9CmCode\\Http\\Controllers\\Icd9CmCodeController@update',
    'permission' => 'medical-record-icd9-cm-code.icd9-cm-code.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2223 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIcd9CmCode\\Http\\Controllers\\Icd9CmCodeController@destroy',
    'permission' => 'medical-record-icd9-cm-code.icd9-cm-code.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2224 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIllnessProgressionHistory\\Http\\Controllers\\IllnessProgressionHistoryController@index',
    'permission' => 'medical-record-illness-progression-history.illness-progression-history.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2225 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIllnessProgressionHistory\\Http\\Controllers\\IllnessProgressionHistoryController@show',
    'permission' => 'medical-record-illness-progression-history.illness-progression-history.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2226 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIllnessProgressionHistory\\Http\\Controllers\\IllnessProgressionHistoryController@store',
    'permission' => 'medical-record-illness-progression-history.illness-progression-history.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2227 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImageMarker\\Http\\Controllers\\ImageMarkerController@index',
    'permission' => 'medical-record-image-marker.image-marker.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2228 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImageMarker\\Http\\Controllers\\ImageMarkerController@show',
    'permission' => 'medical-record-image-marker.image-marker.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2229 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImageMarker\\Http\\Controllers\\ImageMarkerController@store',
    'permission' => 'medical-record-image-marker.image-marker.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2230 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImageMarker\\Http\\Controllers\\ImageMarkerController@update',
    'permission' => 'medical-record-image-marker.image-marker.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2231 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImageMarker\\Http\\Controllers\\ImageMarkerController@destroy',
    'permission' => 'medical-record-image-marker.image-marker.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2232 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImageMarkerPoint\\Http\\Controllers\\ImageMarkerPointController@index',
    'permission' => 'medical-record-image-marker-point.image-marker-point.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2233 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImageMarkerPoint\\Http\\Controllers\\ImageMarkerPointController@show',
    'permission' => 'medical-record-image-marker-point.image-marker-point.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2234 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImageMarkerPoint\\Http\\Controllers\\ImageMarkerPointController@store',
    'permission' => 'medical-record-image-marker-point.image-marker-point.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2235 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImageMarkerPoint\\Http\\Controllers\\ImageMarkerPointController@update',
    'permission' => 'medical-record-image-marker-point.image-marker-point.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2236 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImageMarkerPoint\\Http\\Controllers\\ImageMarkerPointController@destroy',
    'permission' => 'medical-record-image-marker-point.image-marker-point.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2237 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImmunizationVaccination\\Http\\Controllers\\ImmunizationVaccinationController@index',
    'permission' => 'medical-record-immunization-vaccination.immunization-vaccination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2238 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImmunizationVaccination\\Http\\Controllers\\ImmunizationVaccinationController@show',
    'permission' => 'medical-record-immunization-vaccination.immunization-vaccination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2239 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImmunizationVaccination\\Http\\Controllers\\ImmunizationVaccinationController@store',
    'permission' => 'medical-record-immunization-vaccination.immunization-vaccination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2240 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImmunizationVaccination\\Http\\Controllers\\ImmunizationVaccinationController@update',
    'permission' => 'medical-record-immunization-vaccination.immunization-vaccination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2241 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImmunizationVaccination\\Http\\Controllers\\ImmunizationVaccinationController@destroy',
    'permission' => 'medical-record-immunization-vaccination.immunization-vaccination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2242 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImplementation\\Http\\Controllers\\ImplementationController@index',
    'permission' => 'medical-record-implementation.implementation.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2243 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImplementation\\Http\\Controllers\\ImplementationController@show',
    'permission' => 'medical-record-implementation.implementation.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2244 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImplementation\\Http\\Controllers\\ImplementationController@store',
    'permission' => 'medical-record-implementation.implementation.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2245 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImplementation\\Http\\Controllers\\ImplementationController@update',
    'permission' => 'medical-record-implementation.implementation.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2246 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImplementation\\Http\\Controllers\\ImplementationController@destroy',
    'permission' => 'medical-record-implementation.implementation.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2247 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImplementationChecklistItem\\Http\\Controllers\\ImplementationChecklistItemController@index',
    'permission' => 'medical-record-implementation-checklist-item.implementation-checklist-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2248 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImplementationChecklistItem\\Http\\Controllers\\ImplementationChecklistItemController@show',
    'permission' => 'medical-record-implementation-checklist-item.implementation-checklist-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2249 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImplementationChecklistItem\\Http\\Controllers\\ImplementationChecklistItemController@store',
    'permission' => 'medical-record-implementation-checklist-item.implementation-checklist-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2250 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImplementationChecklistItem\\Http\\Controllers\\ImplementationChecklistItemController@update',
    'permission' => 'medical-record-implementation-checklist-item.implementation-checklist-item.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2251 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImplementationChecklistItem\\Http\\Controllers\\ImplementationChecklistItemController@destroy',
    'permission' => 'medical-record-implementation-checklist-item.implementation-checklist-item.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2252 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImplementationNote\\Http\\Controllers\\ImplementationNoteController@index',
    'permission' => 'medical-record-implementation-note.implementation-note.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2253 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImplementationNote\\Http\\Controllers\\ImplementationNoteController@show',
    'permission' => 'medical-record-implementation-note.implementation-note.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2254 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImplementationNote\\Http\\Controllers\\ImplementationNoteController@store',
    'permission' => 'medical-record-implementation-note.implementation-note.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2255 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImplementationNote\\Http\\Controllers\\ImplementationNoteController@update',
    'permission' => 'medical-record-implementation-note.implementation-note.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2256 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordImplementationNote\\Http\\Controllers\\ImplementationNoteController@destroy',
    'permission' => 'medical-record-implementation-note.implementation-note.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2257 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInhalantAllergenExamination\\Http\\Controllers\\InhalantAllergenExaminationController@index',
    'permission' => 'medical-record-inhalant-allergen-examination.inhalant-allergen-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2258 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInhalantAllergenExamination\\Http\\Controllers\\InhalantAllergenExaminationController@show',
    'permission' => 'medical-record-inhalant-allergen-examination.inhalant-allergen-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2259 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInhalantAllergenExamination\\Http\\Controllers\\InhalantAllergenExaminationController@store',
    'permission' => 'medical-record-inhalant-allergen-examination.inhalant-allergen-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2260 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInhalantAllergenExamination\\Http\\Controllers\\InhalantAllergenExaminationController@update',
    'permission' => 'medical-record-inhalant-allergen-examination.inhalant-allergen-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2261 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInhalantAllergenExamination\\Http\\Controllers\\InhalantAllergenExaminationController@destroy',
    'permission' => 'medical-record-inhalant-allergen-examination.inhalant-allergen-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2262 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInpatientCarePlan\\Http\\Controllers\\InpatientCarePlanController@index',
    'permission' => 'medical-record-inpatient-care-plan.inpatient-care-plan.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2263 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInpatientCarePlan\\Http\\Controllers\\InpatientCarePlanController@show',
    'permission' => 'medical-record-inpatient-care-plan.inpatient-care-plan.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2264 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInpatientCarePlan\\Http\\Controllers\\InpatientCarePlanController@store',
    'permission' => 'medical-record-inpatient-care-plan.inpatient-care-plan.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2265 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInpatientCarePlan\\Http\\Controllers\\InpatientCarePlanController@update',
    'permission' => 'medical-record-inpatient-care-plan.inpatient-care-plan.update',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2266 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInterventionIndicatorMapping\\Http\\Controllers\\InterventionIndicatorMappingController@index',
    'permission' => 'medical-record-intervention-indicator-mapping.intervention-indicator-mapping.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2267 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInterventionIndicatorMapping\\Http\\Controllers\\InterventionIndicatorMappingController@show',
    'permission' => 'medical-record-intervention-indicator-mapping.intervention-indicator-mapping.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2268 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInterventionIndicatorMapping\\Http\\Controllers\\InterventionIndicatorMappingController@store',
    'permission' => 'medical-record-intervention-indicator-mapping.intervention-indicator-mapping.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2269 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInterventionIndicatorMapping\\Http\\Controllers\\InterventionIndicatorMappingController@update',
    'permission' => 'medical-record-intervention-indicator-mapping.intervention-indicator-mapping.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2270 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInterventionIndicatorMapping\\Http\\Controllers\\InterventionIndicatorMappingController@destroy',
    'permission' => 'medical-record-intervention-indicator-mapping.intervention-indicator-mapping.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2271 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInterventionProtocol\\Http\\Controllers\\InterventionProtocolController@index',
    'permission' => 'medical-record-intervention-protocol.intervention-protocol.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2272 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInterventionProtocol\\Http\\Controllers\\InterventionProtocolController@show',
    'permission' => 'medical-record-intervention-protocol.intervention-protocol.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2273 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInterventionProtocol\\Http\\Controllers\\InterventionProtocolController@store',
    'permission' => 'medical-record-intervention-protocol.intervention-protocol.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2274 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInterventionProtocol\\Http\\Controllers\\InterventionProtocolController@update',
    'permission' => 'medical-record-intervention-protocol.intervention-protocol.update',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2275 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInterventionProtocolDetail\\Http\\Controllers\\InterventionProtocolDetailController@index',
    'permission' => 'medical-record-intervention-protocol-detail.intervention-protocol-detail.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2276 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInterventionProtocolDetail\\Http\\Controllers\\InterventionProtocolDetailController@show',
    'permission' => 'medical-record-intervention-protocol-detail.intervention-protocol-detail.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2277 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInterventionProtocolDetail\\Http\\Controllers\\InterventionProtocolDetailController@store',
    'permission' => 'medical-record-intervention-protocol-detail.intervention-protocol-detail.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2278 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInterventionRecommendation\\Http\\Controllers\\InterventionRecommendationController@index',
    'permission' => 'medical-record-intervention-recommendation.intervention-recommendation.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2279 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInterventionRecommendation\\Http\\Controllers\\InterventionRecommendationController@show',
    'permission' => 'medical-record-intervention-recommendation.intervention-recommendation.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2280 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInterventionRecommendation\\Http\\Controllers\\InterventionRecommendationController@store',
    'permission' => 'medical-record-intervention-recommendation.intervention-recommendation.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2281 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInterventionRecommendation\\Http\\Controllers\\InterventionRecommendationController@update',
    'permission' => 'medical-record-intervention-recommendation.intervention-recommendation.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2282 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordInterventionRecommendation\\Http\\Controllers\\InterventionRecommendationController@destroy',
    'permission' => 'medical-record-intervention-recommendation.intervention-recommendation.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2283 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIntradialyticHdMonitoring\\Http\\Controllers\\IntradialyticHdMonitoringController@index',
    'permission' => 'medical-record-intradialytic-hd-monitoring.intradialytic-hd-monitoring.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2284 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIntradialyticHdMonitoring\\Http\\Controllers\\IntradialyticHdMonitoringController@show',
    'permission' => 'medical-record-intradialytic-hd-monitoring.intradialytic-hd-monitoring.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2285 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIntradialyticHdMonitoring\\Http\\Controllers\\IntradialyticHdMonitoringController@store',
    'permission' => 'medical-record-intradialytic-hd-monitoring.intradialytic-hd-monitoring.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2286 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIntradialyticHdMonitoring\\Http\\Controllers\\IntradialyticHdMonitoringController@update',
    'permission' => 'medical-record-intradialytic-hd-monitoring.intradialytic-hd-monitoring.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2287 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordIntradialyticHdMonitoring\\Http\\Controllers\\IntradialyticHdMonitoringController@destroy',
    'permission' => 'medical-record-intradialytic-hd-monitoring.intradialytic-hd-monitoring.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2288 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordKillipClassAssessment\\Http\\Controllers\\KillipClassAssessmentController@index',
    'permission' => 'medical-record-killip-class-assessment.killip-class-assessment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2289 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordKillipClassAssessment\\Http\\Controllers\\KillipClassAssessmentController@show',
    'permission' => 'medical-record-killip-class-assessment.killip-class-assessment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2290 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordKillipClassAssessment\\Http\\Controllers\\KillipClassAssessmentController@store',
    'permission' => 'medical-record-killip-class-assessment.killip-class-assessment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2291 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLabResultSummary\\Http\\Controllers\\LabResultSummaryController@index',
    'permission' => 'medical-record-lab-result-summary.lab-result-summary.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2292 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLabResultSummary\\Http\\Controllers\\LabResultSummaryController@show',
    'permission' => 'medical-record-lab-result-summary.lab-result-summary.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2293 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLabResultSummary\\Http\\Controllers\\LabResultSummaryController@store',
    'permission' => 'medical-record-lab-result-summary.lab-result-summary.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2294 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLabResultSummaryItem\\Http\\Controllers\\LabResultSummaryItemController@index',
    'permission' => 'medical-record-lab-result-summary-item.lab-result-summary-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2295 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLabResultSummaryItem\\Http\\Controllers\\LabResultSummaryItemController@show',
    'permission' => 'medical-record-lab-result-summary-item.lab-result-summary-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2296 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLabResultSummaryItem\\Http\\Controllers\\LabResultSummaryItemController@store',
    'permission' => 'medical-record-lab-result-summary-item.lab-result-summary-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2297 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLegJointExamination\\Http\\Controllers\\LegJointExaminationController@index',
    'permission' => 'medical-record-leg-joint-examination.leg-joint-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2298 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLegJointExamination\\Http\\Controllers\\LegJointExaminationController@show',
    'permission' => 'medical-record-leg-joint-examination.leg-joint-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2299 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLegJointExamination\\Http\\Controllers\\LegJointExaminationController@store',
    'permission' => 'medical-record-leg-joint-examination.leg-joint-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2300 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLegJointExamination\\Http\\Controllers\\LegJointExaminationController@update',
    'permission' => 'medical-record-leg-joint-examination.leg-joint-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2301 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLegJointExamination\\Http\\Controllers\\LegJointExaminationController@destroy',
    'permission' => 'medical-record-leg-joint-examination.leg-joint-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2302 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLipExamination\\Http\\Controllers\\LipExaminationController@index',
    'permission' => 'medical-record-lip-examination.lip-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2303 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLipExamination\\Http\\Controllers\\LipExaminationController@show',
    'permission' => 'medical-record-lip-examination.lip-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2304 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLipExamination\\Http\\Controllers\\LipExaminationController@store',
    'permission' => 'medical-record-lip-examination.lip-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2305 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLipExamination\\Http\\Controllers\\LipExaminationController@update',
    'permission' => 'medical-record-lip-examination.lip-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2306 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLipExamination\\Http\\Controllers\\LipExaminationController@destroy',
    'permission' => 'medical-record-lip-examination.lip-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2307 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLowerGiTractExamination\\Http\\Controllers\\LowerGiTractExaminationController@index',
    'permission' => 'medical-record-lower-gi-tract-examination.lower-gi-tract-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2308 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLowerGiTractExamination\\Http\\Controllers\\LowerGiTractExaminationController@show',
    'permission' => 'medical-record-lower-gi-tract-examination.lower-gi-tract-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2309 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLowerGiTractExamination\\Http\\Controllers\\LowerGiTractExaminationController@store',
    'permission' => 'medical-record-lower-gi-tract-examination.lower-gi-tract-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2310 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLowerGiTractExamination\\Http\\Controllers\\LowerGiTractExaminationController@update',
    'permission' => 'medical-record-lower-gi-tract-examination.lower-gi-tract-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2311 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLowerGiTractExamination\\Http\\Controllers\\LowerGiTractExaminationController@destroy',
    'permission' => 'medical-record-lower-gi-tract-examination.lower-gi-tract-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2312 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLowerLegExamination\\Http\\Controllers\\LowerLegExaminationController@index',
    'permission' => 'medical-record-lower-leg-examination.lower-leg-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2313 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLowerLegExamination\\Http\\Controllers\\LowerLegExaminationController@show',
    'permission' => 'medical-record-lower-leg-examination.lower-leg-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2314 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLowerLegExamination\\Http\\Controllers\\LowerLegExaminationController@store',
    'permission' => 'medical-record-lower-leg-examination.lower-leg-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2315 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLowerLegExamination\\Http\\Controllers\\LowerLegExaminationController@update',
    'permission' => 'medical-record-lower-leg-examination.lower-leg-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2316 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordLowerLegExamination\\Http\\Controllers\\LowerLegExaminationController@destroy',
    'permission' => 'medical-record-lower-leg-examination.lower-leg-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2317 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMaternalPregnancyHistory\\Http\\Controllers\\MaternalPregnancyHistoryController@index',
    'permission' => 'medical-record-maternal-pregnancy-history.maternal-pregnancy-history.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2318 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMaternalPregnancyHistory\\Http\\Controllers\\MaternalPregnancyHistoryController@show',
    'permission' => 'medical-record-maternal-pregnancy-history.maternal-pregnancy-history.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2319 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMaternalPregnancyHistory\\Http\\Controllers\\MaternalPregnancyHistoryController@store',
    'permission' => 'medical-record-maternal-pregnancy-history.maternal-pregnancy-history.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2320 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMchatAssessmentExamination\\Http\\Controllers\\MchatAssessmentExaminationController@index',
    'permission' => 'medical-record-mchat-assessment-examination.mchat-assessment-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2321 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMchatAssessmentExamination\\Http\\Controllers\\MchatAssessmentExaminationController@show',
    'permission' => 'medical-record-mchat-assessment-examination.mchat-assessment-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2322 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMchatAssessmentExamination\\Http\\Controllers\\MchatAssessmentExaminationController@store',
    'permission' => 'medical-record-mchat-assessment-examination.mchat-assessment-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2323 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMchatAssessmentExamination\\Http\\Controllers\\MchatAssessmentExaminationController@update',
    'permission' => 'medical-record-mchat-assessment-examination.mchat-assessment-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2324 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMchatAssessmentExamination\\Http\\Controllers\\MchatAssessmentExaminationController@destroy',
    'permission' => 'medical-record-mchat-assessment-examination.mchat-assessment-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2325 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMedicalCheckupResult\\Http\\Controllers\\MedicalCheckupResultController@index',
    'permission' => 'medical-record-medical-checkup-result.medical-checkup-result.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2326 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMedicalCheckupResult\\Http\\Controllers\\MedicalCheckupResultController@show',
    'permission' => 'medical-record-medical-checkup-result.medical-checkup-result.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2327 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMedicalCheckupResult\\Http\\Controllers\\MedicalCheckupResultController@store',
    'permission' => 'medical-record-medical-checkup-result.medical-checkup-result.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2328 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMedicalCheckupResult\\Http\\Controllers\\MedicalCheckupResultController@update',
    'permission' => 'medical-record-medical-checkup-result.medical-checkup-result.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2329 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMedicalCheckupResult\\Http\\Controllers\\MedicalCheckupResultController@destroy',
    'permission' => 'medical-record-medical-checkup-result.medical-checkup-result.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2330 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMedicationAdministrationHistory\\Http\\Controllers\\MedicationAdministrationHistoryController@index',
    'permission' => 'medical-record-medication-administration-history.medication-administration-history.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2331 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMedicationAdministrationHistory\\Http\\Controllers\\MedicationAdministrationHistoryController@show',
    'permission' => 'medical-record-medication-administration-history.medication-administration-history.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2332 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMedicationAdministrationHistory\\Http\\Controllers\\MedicationAdministrationHistoryController@store',
    'permission' => 'medical-record-medication-administration-history.medication-administration-history.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2333 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMmpiTest\\Http\\Controllers\\MmpiTestController@index',
    'permission' => 'medical-record-mmpi-test.mmpi-test.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2334 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMmpiTest\\Http\\Controllers\\MmpiTestController@show',
    'permission' => 'medical-record-mmpi-test.mmpi-test.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2335 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMmpiTest\\Http\\Controllers\\MmpiTestController@store',
    'permission' => 'medical-record-mmpi-test.mmpi-test.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2336 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMmpiTest\\Http\\Controllers\\MmpiTestController@update',
    'permission' => 'medical-record-mmpi-test.mmpi-test.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2337 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMmpiTest\\Http\\Controllers\\MmpiTestController@destroy',
    'permission' => 'medical-record-mmpi-test.mmpi-test.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2338 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordModifiedBarthelIndexAssessment\\Http\\Controllers\\ModifiedBarthelIndexAssessmentController@index',
    'permission' => 'medical-record-modified-barthel-index-assessment.modified-barthel-index-assessment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2339 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordModifiedBarthelIndexAssessment\\Http\\Controllers\\ModifiedBarthelIndexAssessmentController@show',
    'permission' => 'medical-record-modified-barthel-index-assessment.modified-barthel-index-assessment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2340 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordModifiedBarthelIndexAssessment\\Http\\Controllers\\ModifiedBarthelIndexAssessmentController@store',
    'permission' => 'medical-record-modified-barthel-index-assessment.modified-barthel-index-assessment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2341 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordModifiedBarthelIndexAssessment\\Http\\Controllers\\ModifiedBarthelIndexAssessmentController@update',
    'permission' => 'medical-record-modified-barthel-index-assessment.modified-barthel-index-assessment.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2342 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordModifiedBarthelIndexAssessment\\Http\\Controllers\\ModifiedBarthelIndexAssessmentController@destroy',
    'permission' => 'medical-record-modified-barthel-index-assessment.modified-barthel-index-assessment.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2343 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMorseFallScaleAssessment\\Http\\Controllers\\MorseFallScaleAssessmentController@index',
    'permission' => 'medical-record-morse-fall-scale-assessment.morse-fall-scale-assessment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2344 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMorseFallScaleAssessment\\Http\\Controllers\\MorseFallScaleAssessmentController@show',
    'permission' => 'medical-record-morse-fall-scale-assessment.morse-fall-scale-assessment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2345 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordMorseFallScaleAssessment\\Http\\Controllers\\MorseFallScaleAssessmentController@store',
    'permission' => 'medical-record-morse-fall-scale-assessment.morse-fall-scale-assessment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2346 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNeckExamination\\Http\\Controllers\\NeckExaminationController@index',
    'permission' => 'medical-record-neck-examination.neck-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2347 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNeckExamination\\Http\\Controllers\\NeckExaminationController@show',
    'permission' => 'medical-record-neck-examination.neck-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2348 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNeckExamination\\Http\\Controllers\\NeckExaminationController@store',
    'permission' => 'medical-record-neck-examination.neck-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2349 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNeckExamination\\Http\\Controllers\\NeckExaminationController@update',
    'permission' => 'medical-record-neck-examination.neck-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2350 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNeckExamination\\Http\\Controllers\\NeckExaminationController@destroy',
    'permission' => 'medical-record-neck-examination.neck-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2351 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNoseExamination\\Http\\Controllers\\NoseExaminationController@index',
    'permission' => 'medical-record-nose-examination.nose-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2352 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNoseExamination\\Http\\Controllers\\NoseExaminationController@show',
    'permission' => 'medical-record-nose-examination.nose-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2353 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNoseExamination\\Http\\Controllers\\NoseExaminationController@store',
    'permission' => 'medical-record-nose-examination.nose-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2354 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNoseExamination\\Http\\Controllers\\NoseExaminationController@update',
    'permission' => 'medical-record-nose-examination.nose-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2355 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNoseExamination\\Http\\Controllers\\NoseExaminationController@destroy',
    'permission' => 'medical-record-nose-examination.nose-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2356 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingCarePlan\\Http\\Controllers\\NursingCarePlanController@index',
    'permission' => 'medical-record-nursing-care-plan.nursing-care-plan.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2357 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingCarePlan\\Http\\Controllers\\NursingCarePlanController@show',
    'permission' => 'medical-record-nursing-care-plan.nursing-care-plan.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2358 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingCarePlan\\Http\\Controllers\\NursingCarePlanController@store',
    'permission' => 'medical-record-nursing-care-plan.nursing-care-plan.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2359 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingCarePlan\\Http\\Controllers\\NursingCarePlanController@update',
    'permission' => 'medical-record-nursing-care-plan.nursing-care-plan.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2360 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingCarePlan\\Http\\Controllers\\NursingCarePlanController@destroy',
    'permission' => 'medical-record-nursing-care-plan.nursing-care-plan.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2361 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingCarePlanImplementation\\Http\\Controllers\\NursingCarePlanImplementationController@index',
    'permission' => 'medical-record-nursing-care-plan-implementation.nursing-care-plan-implementation.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2362 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingCarePlanImplementation\\Http\\Controllers\\NursingCarePlanImplementationController@show',
    'permission' => 'medical-record-nursing-care-plan-implementation.nursing-care-plan-implementation.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2363 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingCarePlanImplementation\\Http\\Controllers\\NursingCarePlanImplementationController@store',
    'permission' => 'medical-record-nursing-care-plan-implementation.nursing-care-plan-implementation.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2364 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingCarePlanImplementation\\Http\\Controllers\\NursingCarePlanImplementationController@update',
    'permission' => 'medical-record-nursing-care-plan-implementation.nursing-care-plan-implementation.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2365 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingCarePlanImplementation\\Http\\Controllers\\NursingCarePlanImplementationController@destroy',
    'permission' => 'medical-record-nursing-care-plan-implementation.nursing-care-plan-implementation.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2366 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingDiagnosis\\Http\\Controllers\\NursingDiagnosisController@index',
    'permission' => 'medical-record-nursing-diagnosis.nursing-diagnosis.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2367 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingDiagnosis\\Http\\Controllers\\NursingDiagnosisController@show',
    'permission' => 'medical-record-nursing-diagnosis.nursing-diagnosis.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2368 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingDiagnosis\\Http\\Controllers\\NursingDiagnosisController@store',
    'permission' => 'medical-record-nursing-diagnosis.nursing-diagnosis.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2369 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingDiagnosis\\Http\\Controllers\\NursingDiagnosisController@update',
    'permission' => 'medical-record-nursing-diagnosis.nursing-diagnosis.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2370 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingDiagnosis\\Http\\Controllers\\NursingDiagnosisController@destroy',
    'permission' => 'medical-record-nursing-diagnosis.nursing-diagnosis.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2371 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingImplementation\\Http\\Controllers\\NursingImplementationController@index',
    'permission' => 'medical-record-nursing-implementation.nursing-implementation.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2372 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingImplementation\\Http\\Controllers\\NursingImplementationController@show',
    'permission' => 'medical-record-nursing-implementation.nursing-implementation.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2373 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingImplementation\\Http\\Controllers\\NursingImplementationController@store',
    'permission' => 'medical-record-nursing-implementation.nursing-implementation.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2374 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingImplementation\\Http\\Controllers\\NursingImplementationController@update',
    'permission' => 'medical-record-nursing-implementation.nursing-implementation.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2375 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingImplementation\\Http\\Controllers\\NursingImplementationController@destroy',
    'permission' => 'medical-record-nursing-implementation.nursing-implementation.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2376 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingIndicator\\Http\\Controllers\\NursingIndicatorController@index',
    'permission' => 'medical-record-nursing-indicator.nursing-indicator.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2377 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingIndicator\\Http\\Controllers\\NursingIndicatorController@show',
    'permission' => 'medical-record-nursing-indicator.nursing-indicator.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2378 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingIndicator\\Http\\Controllers\\NursingIndicatorController@store',
    'permission' => 'medical-record-nursing-indicator.nursing-indicator.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2379 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingIndicator\\Http\\Controllers\\NursingIndicatorController@update',
    'permission' => 'medical-record-nursing-indicator.nursing-indicator.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2380 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingIndicator\\Http\\Controllers\\NursingIndicatorController@destroy',
    'permission' => 'medical-record-nursing-indicator.nursing-indicator.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2381 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingIndicatorImplementation\\Http\\Controllers\\NursingIndicatorImplementationController@index',
    'permission' => 'medical-record-nursing-indicator-implementation.nursing-indicator-implementation.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2382 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingIndicatorImplementation\\Http\\Controllers\\NursingIndicatorImplementationController@show',
    'permission' => 'medical-record-nursing-indicator-implementation.nursing-indicator-implementation.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2383 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingIndicatorImplementation\\Http\\Controllers\\NursingIndicatorImplementationController@store',
    'permission' => 'medical-record-nursing-indicator-implementation.nursing-indicator-implementation.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2384 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingIndicatorImplementation\\Http\\Controllers\\NursingIndicatorImplementationController@destroy',
    'permission' => 'medical-record-nursing-indicator-implementation.nursing-indicator-implementation.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2385 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingIndicatorType\\Http\\Controllers\\NursingIndicatorTypeController@index',
    'permission' => 'medical-record-nursing-indicator-type.nursing-indicator-type.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2386 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingIndicatorType\\Http\\Controllers\\NursingIndicatorTypeController@show',
    'permission' => 'medical-record-nursing-indicator-type.nursing-indicator-type.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2387 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingIndicatorType\\Http\\Controllers\\NursingIndicatorTypeController@store',
    'permission' => 'medical-record-nursing-indicator-type.nursing-indicator-type.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2388 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingIndicatorType\\Http\\Controllers\\NursingIndicatorTypeController@update',
    'permission' => 'medical-record-nursing-indicator-type.nursing-indicator-type.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2389 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNursingIndicatorType\\Http\\Controllers\\NursingIndicatorTypeController@destroy',
    'permission' => 'medical-record-nursing-indicator-type.nursing-indicator-type.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2390 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNutritionDietPattern\\Http\\Controllers\\NutritionDietPatternController@index',
    'permission' => 'medical-record-nutrition-diet-pattern.nutrition-diet-pattern.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2391 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNutritionDietPattern\\Http\\Controllers\\NutritionDietPatternController@show',
    'permission' => 'medical-record-nutrition-diet-pattern.nutrition-diet-pattern.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2392 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordNutritionDietPattern\\Http\\Controllers\\NutritionDietPatternController@store',
    'permission' => 'medical-record-nutrition-diet-pattern.nutrition-diet-pattern.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2393 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordObstetricHistory\\Http\\Controllers\\ObstetricHistoryController@index',
    'permission' => 'medical-record-obstetric-history.obstetric-history.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2394 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordObstetricHistory\\Http\\Controllers\\ObstetricHistoryController@show',
    'permission' => 'medical-record-obstetric-history.obstetric-history.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2395 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordObstetricHistory\\Http\\Controllers\\ObstetricHistoryController@store',
    'permission' => 'medical-record-obstetric-history.obstetric-history.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2396 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordObstetrics\\Http\\Controllers\\ObstetricsController@index',
    'permission' => 'medical-record-obstetrics.obstetrics.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2397 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordObstetrics\\Http\\Controllers\\ObstetricsController@show',
    'permission' => 'medical-record-obstetrics.obstetrics.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2398 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordObstetrics\\Http\\Controllers\\ObstetricsController@store',
    'permission' => 'medical-record-obstetrics.obstetrics.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2399 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordObstetrics\\Http\\Controllers\\ObstetricsController@update',
    'permission' => 'medical-record-obstetrics.obstetrics.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2400 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordObstetrics\\Http\\Controllers\\ObstetricsController@destroy',
    'permission' => 'medical-record-obstetrics.obstetrics.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2401 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordOtherHistory\\Http\\Controllers\\OtherHistoryController@index',
    'permission' => 'medical-record-other-history.other-history.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2402 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordOtherHistory\\Http\\Controllers\\OtherHistoryController@show',
    'permission' => 'medical-record-other-history.other-history.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2403 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordOtherHistory\\Http\\Controllers\\OtherHistoryController@store',
    'permission' => 'medical-record-other-history.other-history.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2404 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPainScoreAssessment\\Http\\Controllers\\PainScoreAssessmentController@index',
    'permission' => 'medical-record-pain-score-assessment.pain-score-assessment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2405 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPainScoreAssessment\\Http\\Controllers\\PainScoreAssessmentController@show',
    'permission' => 'medical-record-pain-score-assessment.pain-score-assessment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2406 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPainScoreAssessment\\Http\\Controllers\\PainScoreAssessmentController@store',
    'permission' => 'medical-record-pain-score-assessment.pain-score-assessment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2407 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPalateExamination\\Http\\Controllers\\PalateExaminationController@index',
    'permission' => 'medical-record-palate-examination.palate-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2408 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPalateExamination\\Http\\Controllers\\PalateExaminationController@show',
    'permission' => 'medical-record-palate-examination.palate-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2409 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPalateExamination\\Http\\Controllers\\PalateExaminationController@store',
    'permission' => 'medical-record-palate-examination.palate-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2410 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPalateExamination\\Http\\Controllers\\PalateExaminationController@update',
    'permission' => 'medical-record-palate-examination.palate-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2411 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPalateExamination\\Http\\Controllers\\PalateExaminationController@destroy',
    'permission' => 'medical-record-palate-examination.palate-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2412 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordParentalHealthHistoryScreening\\Http\\Controllers\\ParentalHealthHistoryScreeningController@index',
    'permission' => 'medical-record-parental-health-history-screening.parental-health-history-screening.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2413 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordParentalHealthHistoryScreening\\Http\\Controllers\\ParentalHealthHistoryScreeningController@show',
    'permission' => 'medical-record-parental-health-history-screening.parental-health-history-screening.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2414 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordParentalHealthHistoryScreening\\Http\\Controllers\\ParentalHealthHistoryScreeningController@store',
    'permission' => 'medical-record-parental-health-history-screening.parental-health-history-screening.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2415 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPatientFamilyEducation\\Http\\Controllers\\PatientFamilyEducationController@index',
    'permission' => 'medical-record-patient-family-education.patient-family-education.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2416 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPatientFamilyEducation\\Http\\Controllers\\PatientFamilyEducationController@show',
    'permission' => 'medical-record-patient-family-education.patient-family-education.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2417 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPatientFamilyEducation\\Http\\Controllers\\PatientFamilyEducationController@store',
    'permission' => 'medical-record-patient-family-education.patient-family-education.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2418 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPatientFamilyEducation\\Http\\Controllers\\PatientFamilyEducationController@update',
    'permission' => 'medical-record-patient-family-education.patient-family-education.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2419 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPatientFamilyEducation\\Http\\Controllers\\PatientFamilyEducationController@destroy',
    'permission' => 'medical-record-patient-family-education.patient-family-education.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2420 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPatientNutritionProblem\\Http\\Controllers\\PatientNutritionProblemController@index',
    'permission' => 'medical-record-patient-nutrition-problem.patient-nutrition-problem.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2421 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPatientNutritionProblem\\Http\\Controllers\\PatientNutritionProblemController@show',
    'permission' => 'medical-record-patient-nutrition-problem.patient-nutrition-problem.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2422 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPatientNutritionProblem\\Http\\Controllers\\PatientNutritionProblemController@store',
    'permission' => 'medical-record-patient-nutrition-problem.patient-nutrition-problem.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2423 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPatientNutritionProblem\\Http\\Controllers\\PatientNutritionProblemController@update',
    'permission' => 'medical-record-patient-nutrition-problem.patient-nutrition-problem.update',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2424 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPatientTransferSheet\\Http\\Controllers\\PatientTransferSheetController@index',
    'permission' => 'medical-record-patient-transfer-sheet.patient-transfer-sheet.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2425 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPatientTransferSheet\\Http\\Controllers\\PatientTransferSheetController@show',
    'permission' => 'medical-record-patient-transfer-sheet.patient-transfer-sheet.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2426 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPatientTransferSheet\\Http\\Controllers\\PatientTransferSheetController@store',
    'permission' => 'medical-record-patient-transfer-sheet.patient-transfer-sheet.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2427 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPatientTransferSheet\\Http\\Controllers\\PatientTransferSheetController@update',
    'permission' => 'medical-record-patient-transfer-sheet.patient-transfer-sheet.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2428 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPatientTransferSheet\\Http\\Controllers\\PatientTransferSheetController@destroy',
    'permission' => 'medical-record-patient-transfer-sheet.patient-transfer-sheet.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2429 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPediatricStatus\\Http\\Controllers\\PediatricStatusController@index',
    'permission' => 'medical-record-pediatric-status.pediatric-status.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2430 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPediatricStatus\\Http\\Controllers\\PediatricStatusController@show',
    'permission' => 'medical-record-pediatric-status.pediatric-status.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2431 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPediatricStatus\\Http\\Controllers\\PediatricStatusController@store',
    'permission' => 'medical-record-pediatric-status.pediatric-status.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2432 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPediatricStatus\\Http\\Controllers\\PediatricStatusController@update',
    'permission' => 'medical-record-pediatric-status.pediatric-status.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2433 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPediatricStatus\\Http\\Controllers\\PediatricStatusController@destroy',
    'permission' => 'medical-record-pediatric-status.pediatric-status.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2434 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPharmacyDiagnosis\\Http\\Controllers\\PharmacyDiagnosisController@index',
    'permission' => 'medical-record-pharmacy-diagnosis.pharmacy-diagnosis.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2435 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPharmacyDiagnosis\\Http\\Controllers\\PharmacyDiagnosisController@show',
    'permission' => 'medical-record-pharmacy-diagnosis.pharmacy-diagnosis.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2436 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPharmacyDiagnosis\\Http\\Controllers\\PharmacyDiagnosisController@store',
    'permission' => 'medical-record-pharmacy-diagnosis.pharmacy-diagnosis.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2437 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPharmacyDiagnosis\\Http\\Controllers\\PharmacyDiagnosisController@update',
    'permission' => 'medical-record-pharmacy-diagnosis.pharmacy-diagnosis.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2438 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPharmacyDiagnosis\\Http\\Controllers\\PharmacyDiagnosisController@destroy',
    'permission' => 'medical-record-pharmacy-diagnosis.pharmacy-diagnosis.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2439 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPharynxExamination\\Http\\Controllers\\PharynxExaminationController@index',
    'permission' => 'medical-record-pharynx-examination.pharynx-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2440 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPharynxExamination\\Http\\Controllers\\PharynxExaminationController@show',
    'permission' => 'medical-record-pharynx-examination.pharynx-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2441 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPharynxExamination\\Http\\Controllers\\PharynxExaminationController@store',
    'permission' => 'medical-record-pharynx-examination.pharynx-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2442 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPharynxExamination\\Http\\Controllers\\PharynxExaminationController@update',
    'permission' => 'medical-record-pharynx-examination.pharynx-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2443 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPharynxExamination\\Http\\Controllers\\PharynxExaminationController@destroy',
    'permission' => 'medical-record-pharynx-examination.pharynx-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2444 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPhysicalAssessment\\Http\\Controllers\\PhysicalAssessmentController@index',
    'permission' => 'medical-record-physical-assessment.physical-assessment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2445 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPhysicalAssessment\\Http\\Controllers\\PhysicalAssessmentController@show',
    'permission' => 'medical-record-physical-assessment.physical-assessment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2446 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPhysicalAssessment\\Http\\Controllers\\PhysicalAssessmentController@store',
    'permission' => 'medical-record-physical-assessment.physical-assessment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2447 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPhysicalAssessment\\Http\\Controllers\\PhysicalAssessmentController@update',
    'permission' => 'medical-record-physical-assessment.physical-assessment.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2448 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPhysicalAssessment\\Http\\Controllers\\PhysicalAssessmentController@destroy',
    'permission' => 'medical-record-physical-assessment.physical-assessment.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2449 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPhysicalExamination\\Http\\Controllers\\PhysicalExaminationController@index',
    'permission' => 'medical-record-physical-examination.physical-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2450 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPhysicalExamination\\Http\\Controllers\\PhysicalExaminationController@show',
    'permission' => 'medical-record-physical-examination.physical-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2451 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPhysicalExamination\\Http\\Controllers\\PhysicalExaminationController@store',
    'permission' => 'medical-record-physical-examination.physical-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2452 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPhysicalExamination\\Http\\Controllers\\PhysicalExaminationController@update',
    'permission' => 'medical-record-physical-examination.physical-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2453 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPhysicalExamination\\Http\\Controllers\\PhysicalExaminationController@destroy',
    'permission' => 'medical-record-physical-examination.physical-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2454 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPlanAndTherapy\\Http\\Controllers\\PlanAndTherapyController@index',
    'permission' => 'medical-record-plan-and-therapy.plan-and-therapy.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2455 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPlanAndTherapy\\Http\\Controllers\\PlanAndTherapyController@show',
    'permission' => 'medical-record-plan-and-therapy.plan-and-therapy.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2456 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPlanAndTherapy\\Http\\Controllers\\PlanAndTherapyController@store',
    'permission' => 'medical-record-plan-and-therapy.plan-and-therapy.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2457 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPlanAndTherapy\\Http\\Controllers\\PlanAndTherapyController@update',
    'permission' => 'medical-record-plan-and-therapy.plan-and-therapy.update',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2458 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPreAnesthesiaSedationAssessment\\Http\\Controllers\\PreAnesthesiaSedationAssessmentController@index',
    'permission' => 'medical-record-pre-anesthesia-sedation-assessment.pre-anesthesia-sedation-assessment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2459 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPreAnesthesiaSedationAssessment\\Http\\Controllers\\PreAnesthesiaSedationAssessmentController@show',
    'permission' => 'medical-record-pre-anesthesia-sedation-assessment.pre-anesthesia-sedation-assessment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2460 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPreAnesthesiaSedationAssessment\\Http\\Controllers\\PreAnesthesiaSedationAssessmentController@store',
    'permission' => 'medical-record-pre-anesthesia-sedation-assessment.pre-anesthesia-sedation-assessment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2461 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPressureUlcerRiskAssessment\\Http\\Controllers\\PressureUlcerRiskAssessmentController@index',
    'permission' => 'medical-record-pressure-ulcer-risk-assessment.pressure-ulcer-risk-assessment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2462 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPressureUlcerRiskAssessment\\Http\\Controllers\\PressureUlcerRiskAssessmentController@show',
    'permission' => 'medical-record-pressure-ulcer-risk-assessment.pressure-ulcer-risk-assessment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2463 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPressureUlcerRiskAssessment\\Http\\Controllers\\PressureUlcerRiskAssessmentController@store',
    'permission' => 'medical-record-pressure-ulcer-risk-assessment.pressure-ulcer-risk-assessment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2464 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPressureUlcerRiskAssessment\\Http\\Controllers\\PressureUlcerRiskAssessmentController@update',
    'permission' => 'medical-record-pressure-ulcer-risk-assessment.pressure-ulcer-risk-assessment.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2465 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordPressureUlcerRiskAssessment\\Http\\Controllers\\PressureUlcerRiskAssessmentController@destroy',
    'permission' => 'medical-record-pressure-ulcer-risk-assessment.pressure-ulcer-risk-assessment.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2466 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordProcedureConsentInformation\\Http\\Controllers\\ProcedureConsentInformationController@index',
    'permission' => 'medical-record-procedure-consent-information.procedure-consent-information.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2467 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordProcedureConsentInformation\\Http\\Controllers\\ProcedureConsentInformationController@show',
    'permission' => 'medical-record-procedure-consent-information.procedure-consent-information.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2468 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordProcedureConsentInformation\\Http\\Controllers\\ProcedureConsentInformationController@store',
    'permission' => 'medical-record-procedure-consent-information.procedure-consent-information.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2469 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordProcedureConsentInformationGiver\\Http\\Controllers\\ProcedureConsentInformationGiverController@index',
    'permission' => 'medical-record-procedure-consent-information-giver.procedure-consent-information-giver.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2470 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordProcedureConsentInformationGiver\\Http\\Controllers\\ProcedureConsentInformationGiverController@show',
    'permission' => 'medical-record-procedure-consent-information-giver.procedure-consent-information-giver.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2471 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordProcedureConsentInformationGiver\\Http\\Controllers\\ProcedureConsentInformationGiverController@store',
    'permission' => 'medical-record-procedure-consent-information-giver.procedure-consent-information-giver.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2472 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordProcedureConsentInformationItem\\Http\\Controllers\\ProcedureConsentInformationItemController@index',
    'permission' => 'medical-record-procedure-consent-information-item.procedure-consent-information-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2473 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordProcedureConsentInformationItem\\Http\\Controllers\\ProcedureConsentInformationItemController@show',
    'permission' => 'medical-record-procedure-consent-information-item.procedure-consent-information-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2474 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordProcedureConsentInformationItem\\Http\\Controllers\\ProcedureConsentInformationItemController@store',
    'permission' => 'medical-record-procedure-consent-information-item.procedure-consent-information-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2475 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordProcedureConsentInformationReceiver\\Http\\Controllers\\ProcedureConsentInformationReceiverController@index',
    'permission' => 'medical-record-procedure-consent-information-receiver.procedure-consent-information-receiver.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2476 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordProcedureConsentInformationReceiver\\Http\\Controllers\\ProcedureConsentInformationReceiverController@show',
    'permission' => 'medical-record-procedure-consent-information-receiver.procedure-consent-information-receiver.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2477 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordProcedureConsentInformationReceiver\\Http\\Controllers\\ProcedureConsentInformationReceiverController@store',
    'permission' => 'medical-record-procedure-consent-information-receiver.procedure-consent-information-receiver.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2478 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordProcedureConsentPatientAcknowledgement\\Http\\Controllers\\ProcedureConsentPatientAcknowledgementController@index',
    'permission' => 'medical-record-procedure-consent-patient-acknowledgement.procedure-consent-patient-acknowledgement.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2479 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordProcedureConsentPatientAcknowledgement\\Http\\Controllers\\ProcedureConsentPatientAcknowledgementController@show',
    'permission' => 'medical-record-procedure-consent-patient-acknowledgement.procedure-consent-patient-acknowledgement.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2480 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordProcedureConsentPatientAcknowledgement\\Http\\Controllers\\ProcedureConsentPatientAcknowledgementController@store',
    'permission' => 'medical-record-procedure-consent-patient-acknowledgement.procedure-consent-patient-acknowledgement.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2481 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordProcedureSurgery\\Http\\Controllers\\ProcedureSurgeryController@index',
    'permission' => 'medical-record-procedure-surgery.procedure-surgery.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2482 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordProcedureSurgery\\Http\\Controllers\\ProcedureSurgeryController@show',
    'permission' => 'medical-record-procedure-surgery.procedure-surgery.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2483 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordProcedureSurgery\\Http\\Controllers\\ProcedureSurgeryController@store',
    'permission' => 'medical-record-procedure-surgery.procedure-surgery.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2484 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordProcedureSurgery\\Http\\Controllers\\ProcedureSurgeryController@update',
    'permission' => 'medical-record-procedure-surgery.procedure-surgery.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2485 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordProcedureSurgery\\Http\\Controllers\\ProcedureSurgeryController@destroy',
    'permission' => 'medical-record-procedure-surgery.procedure-surgery.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2486 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRadiologyResultSummary\\Http\\Controllers\\RadiologyResultSummaryController@index',
    'permission' => 'medical-record-radiology-result-summary.radiology-result-summary.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2487 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRadiologyResultSummary\\Http\\Controllers\\RadiologyResultSummaryController@show',
    'permission' => 'medical-record-radiology-result-summary.radiology-result-summary.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2488 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRadiologyResultSummary\\Http\\Controllers\\RadiologyResultSummaryController@store',
    'permission' => 'medical-record-radiology-result-summary.radiology-result-summary.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2489 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRadiologyResultSummaryItem\\Http\\Controllers\\RadiologyResultSummaryItemController@index',
    'permission' => 'medical-record-radiology-result-summary-item.radiology-result-summary-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2490 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRadiologyResultSummaryItem\\Http\\Controllers\\RadiologyResultSummaryItemController@show',
    'permission' => 'medical-record-radiology-result-summary-item.radiology-result-summary-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2491 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRadiologyResultSummaryItem\\Http\\Controllers\\RadiologyResultSummaryItemController@store',
    'permission' => 'medical-record-radiology-result-summary-item.radiology-result-summary-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2492 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRavenTestExamination\\Http\\Controllers\\RavenTestExaminationController@index',
    'permission' => 'medical-record-raven-test-examination.raven-test-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2493 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRavenTestExamination\\Http\\Controllers\\RavenTestExaminationController@show',
    'permission' => 'medical-record-raven-test-examination.raven-test-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2494 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRavenTestExamination\\Http\\Controllers\\RavenTestExaminationController@store',
    'permission' => 'medical-record-raven-test-examination.raven-test-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2495 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRavenTestExamination\\Http\\Controllers\\RavenTestExaminationController@update',
    'permission' => 'medical-record-raven-test-examination.raven-test-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2496 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRavenTestExamination\\Http\\Controllers\\RavenTestExaminationController@destroy',
    'permission' => 'medical-record-raven-test-examination.raven-test-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2497 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRecordFileLoan\\Http\\Controllers\\RecordFileLoanController@index',
    'permission' => 'medical-record-record-file-loan.record-file-loan.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2498 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRecordFileLoan\\Http\\Controllers\\RecordFileLoanController@show',
    'permission' => 'medical-record-record-file-loan.record-file-loan.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2499 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRecordFileLoan\\Http\\Controllers\\RecordFileLoanController@store',
    'permission' => 'medical-record-record-file-loan.record-file-loan.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2500 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRecordFileLoan\\Http\\Controllers\\RecordFileLoanController@update',
    'permission' => 'medical-record-record-file-loan.record-file-loan.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2501 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRecordFileLoan\\Http\\Controllers\\RecordFileLoanController@destroy',
    'permission' => 'medical-record-record-file-loan.record-file-loan.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2502 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRecordFileLoan\\Http\\Controllers\\RecordFileLoanController@transition',
    'permission' => 'medical-record-record-file-loan.record-file-loan.transition',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2503 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRehabilitationProcedureExamination\\Http\\Controllers\\RehabilitationProcedureExaminationController@index',
    'permission' => 'medical-record-rehabilitation-procedure-examination.rehabilitation-procedure-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2504 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRehabilitationProcedureExamination\\Http\\Controllers\\RehabilitationProcedureExaminationController@show',
    'permission' => 'medical-record-rehabilitation-procedure-examination.rehabilitation-procedure-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2505 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRehabilitationProcedureExamination\\Http\\Controllers\\RehabilitationProcedureExaminationController@store',
    'permission' => 'medical-record-rehabilitation-procedure-examination.rehabilitation-procedure-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2506 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRehabilitationProcedureExamination\\Http\\Controllers\\RehabilitationProcedureExaminationController@update',
    'permission' => 'medical-record-rehabilitation-procedure-examination.rehabilitation-procedure-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2507 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRehabilitationProcedureExamination\\Http\\Controllers\\RehabilitationProcedureExaminationController@destroy',
    'permission' => 'medical-record-rehabilitation-procedure-examination.rehabilitation-procedure-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2508 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRehabilitationProcedureExaminationItem\\Http\\Controllers\\RehabilitationProcedureExaminationItemController@index',
    'permission' => 'medical-record-rehabilitation-procedure-examination-item.rehabilitation-procedure-examination-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2509 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRehabilitationProcedureExaminationItem\\Http\\Controllers\\RehabilitationProcedureExaminationItemController@show',
    'permission' => 'medical-record-rehabilitation-procedure-examination-item.rehabilitation-procedure-examination-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2510 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRehabilitationProcedureExaminationItem\\Http\\Controllers\\RehabilitationProcedureExaminationItemController@store',
    'permission' => 'medical-record-rehabilitation-procedure-examination-item.rehabilitation-procedure-examination-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2511 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRehabilitationProcedureExaminationItem\\Http\\Controllers\\RehabilitationProcedureExaminationItemController@update',
    'permission' => 'medical-record-rehabilitation-procedure-examination-item.rehabilitation-procedure-examination-item.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2512 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRehabilitationProcedureExaminationItem\\Http\\Controllers\\RehabilitationProcedureExaminationItemController@destroy',
    'permission' => 'medical-record-rehabilitation-procedure-examination-item.rehabilitation-procedure-examination-item.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2513 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRetentionSchedule\\Http\\Controllers\\RetentionScheduleController@index',
    'permission' => 'medical-record-retention-schedule.retention-schedule.index',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  2514 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRetentionSchedule\\Http\\Controllers\\RetentionScheduleController@show',
    'permission' => 'medical-record-retention-schedule.retention-schedule.show',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  2515 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRiskFactor\\Http\\Controllers\\RiskFactorController@index',
    'permission' => 'medical-record-risk-factor.risk-factor.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2516 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRiskFactor\\Http\\Controllers\\RiskFactorController@show',
    'permission' => 'medical-record-risk-factor.risk-factor.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2517 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRiskFactor\\Http\\Controllers\\RiskFactorController@store',
    'permission' => 'medical-record-risk-factor.risk-factor.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2518 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRiskFactor\\Http\\Controllers\\RiskFactorController@update',
    'permission' => 'medical-record-risk-factor.risk-factor.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2519 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordRiskFactor\\Http\\Controllers\\RiskFactorController@destroy',
    'permission' => 'medical-record-risk-factor.risk-factor.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2520 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSickLeaveCertificate\\Http\\Controllers\\SickLeaveCertificateController@index',
    'permission' => 'medical-record-sick-leave-certificate.sick-leave-certificate.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2521 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSickLeaveCertificate\\Http\\Controllers\\SickLeaveCertificateController@show',
    'permission' => 'medical-record-sick-leave-certificate.sick-leave-certificate.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2522 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSickLeaveCertificate\\Http\\Controllers\\SickLeaveCertificateController@store',
    'permission' => 'medical-record-sick-leave-certificate.sick-leave-certificate.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2523 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSickLeaveCertificate\\Http\\Controllers\\SickLeaveCertificateController@update',
    'permission' => 'medical-record-sick-leave-certificate.sick-leave-certificate.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2524 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSickLeaveCertificate\\Http\\Controllers\\SickLeaveCertificateController@destroy',
    'permission' => 'medical-record-sick-leave-certificate.sick-leave-certificate.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2525 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSkinPrickTestExamination\\Http\\Controllers\\SkinPrickTestExaminationController@index',
    'permission' => 'medical-record-skin-prick-test-examination.skin-prick-test-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2526 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSkinPrickTestExamination\\Http\\Controllers\\SkinPrickTestExaminationController@show',
    'permission' => 'medical-record-skin-prick-test-examination.skin-prick-test-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2527 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSkinPrickTestExamination\\Http\\Controllers\\SkinPrickTestExaminationController@store',
    'permission' => 'medical-record-skin-prick-test-examination.skin-prick-test-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2528 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSkinPrickTestExamination\\Http\\Controllers\\SkinPrickTestExaminationController@update',
    'permission' => 'medical-record-skin-prick-test-examination.skin-prick-test-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2529 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSkinPrickTestExamination\\Http\\Controllers\\SkinPrickTestExaminationController@destroy',
    'permission' => 'medical-record-skin-prick-test-examination.skin-prick-test-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2530 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSocialCondition\\Http\\Controllers\\SocialConditionController@index',
    'permission' => 'medical-record-social-condition.social-condition.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2531 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSocialCondition\\Http\\Controllers\\SocialConditionController@show',
    'permission' => 'medical-record-social-condition.social-condition.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2532 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSocialCondition\\Http\\Controllers\\SocialConditionController@store',
    'permission' => 'medical-record-social-condition.social-condition.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2533 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSocialCondition\\Http\\Controllers\\SocialConditionController@update',
    'permission' => 'medical-record-social-condition.social-condition.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2534 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSocialCondition\\Http\\Controllers\\SocialConditionController@destroy',
    'permission' => 'medical-record-social-condition.social-condition.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2535 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSurgery\\Http\\Controllers\\SurgeryController@index',
    'permission' => 'medical-record-surgery.surgery.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2536 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSurgery\\Http\\Controllers\\SurgeryController@show',
    'permission' => 'medical-record-surgery.surgery.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2537 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSurgery\\Http\\Controllers\\SurgeryController@store',
    'permission' => 'medical-record-surgery.surgery.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2538 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSurgery\\Http\\Controllers\\SurgeryController@update',
    'permission' => 'medical-record-surgery.surgery.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2539 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSurgeryPerformer\\Http\\Controllers\\SurgeryPerformerController@index',
    'permission' => 'medical-record-surgery-performer.surgery-performer.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2540 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSurgeryPerformer\\Http\\Controllers\\SurgeryPerformerController@show',
    'permission' => 'medical-record-surgery-performer.surgery-performer.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2541 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSurgeryPerformer\\Http\\Controllers\\SurgeryPerformerController@store',
    'permission' => 'medical-record-surgery-performer.surgery-performer.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2542 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSurgeryPerformer\\Http\\Controllers\\SurgeryPerformerController@update',
    'permission' => 'medical-record-surgery-performer.surgery-performer.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2543 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSurgeryPerformer\\Http\\Controllers\\SurgeryPerformerController@destroy',
    'permission' => 'medical-record-surgery-performer.surgery-performer.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2544 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSurgicalProcedureHistory\\Http\\Controllers\\SurgicalProcedureHistoryController@index',
    'permission' => 'medical-record-surgical-procedure-history.surgical-procedure-history.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2545 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSurgicalProcedureHistory\\Http\\Controllers\\SurgicalProcedureHistoryController@show',
    'permission' => 'medical-record-surgical-procedure-history.surgical-procedure-history.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2546 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordSurgicalProcedureHistory\\Http\\Controllers\\SurgicalProcedureHistoryController@store',
    'permission' => 'medical-record-surgical-procedure-history.surgical-procedure-history.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2547 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTbDiseaseHistory\\Http\\Controllers\\TbDiseaseHistoryController@index',
    'permission' => 'medical-record-tb-disease-history.tb-disease-history.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2548 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTbDiseaseHistory\\Http\\Controllers\\TbDiseaseHistoryController@show',
    'permission' => 'medical-record-tb-disease-history.tb-disease-history.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2549 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTbDiseaseHistory\\Http\\Controllers\\TbDiseaseHistoryController@store',
    'permission' => 'medical-record-tb-disease-history.tb-disease-history.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2550 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordThighExamination\\Http\\Controllers\\ThighExaminationController@index',
    'permission' => 'medical-record-thigh-examination.thigh-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2551 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordThighExamination\\Http\\Controllers\\ThighExaminationController@show',
    'permission' => 'medical-record-thigh-examination.thigh-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2552 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordThighExamination\\Http\\Controllers\\ThighExaminationController@store',
    'permission' => 'medical-record-thigh-examination.thigh-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2553 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordThighExamination\\Http\\Controllers\\ThighExaminationController@update',
    'permission' => 'medical-record-thigh-examination.thigh-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2554 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordThighExamination\\Http\\Controllers\\ThighExaminationController@destroy',
    'permission' => 'medical-record-thigh-examination.thigh-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2555 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordThroatExamination\\Http\\Controllers\\ThroatExaminationController@index',
    'permission' => 'medical-record-throat-examination.throat-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2556 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordThroatExamination\\Http\\Controllers\\ThroatExaminationController@show',
    'permission' => 'medical-record-throat-examination.throat-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2557 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordThroatExamination\\Http\\Controllers\\ThroatExaminationController@store',
    'permission' => 'medical-record-throat-examination.throat-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2558 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordThroatExamination\\Http\\Controllers\\ThroatExaminationController@update',
    'permission' => 'medical-record-throat-examination.throat-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2559 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordThroatExamination\\Http\\Controllers\\ThroatExaminationController@destroy',
    'permission' => 'medical-record-throat-examination.throat-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2560 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordToeExamination\\Http\\Controllers\\ToeExaminationController@index',
    'permission' => 'medical-record-toe-examination.toe-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2561 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordToeExamination\\Http\\Controllers\\ToeExaminationController@show',
    'permission' => 'medical-record-toe-examination.toe-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2562 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordToeExamination\\Http\\Controllers\\ToeExaminationController@store',
    'permission' => 'medical-record-toe-examination.toe-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2563 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordToeExamination\\Http\\Controllers\\ToeExaminationController@update',
    'permission' => 'medical-record-toe-examination.toe-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2564 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordToeExamination\\Http\\Controllers\\ToeExaminationController@destroy',
    'permission' => 'medical-record-toe-examination.toe-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2565 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordToenailExamination\\Http\\Controllers\\ToenailExaminationController@index',
    'permission' => 'medical-record-toenail-examination.toenail-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2566 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordToenailExamination\\Http\\Controllers\\ToenailExaminationController@show',
    'permission' => 'medical-record-toenail-examination.toenail-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2567 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordToenailExamination\\Http\\Controllers\\ToenailExaminationController@store',
    'permission' => 'medical-record-toenail-examination.toenail-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2568 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordToenailExamination\\Http\\Controllers\\ToenailExaminationController@update',
    'permission' => 'medical-record-toenail-examination.toenail-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2569 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordToenailExamination\\Http\\Controllers\\ToenailExaminationController@destroy',
    'permission' => 'medical-record-toenail-examination.toenail-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2570 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTongueExamination\\Http\\Controllers\\TongueExaminationController@index',
    'permission' => 'medical-record-tongue-examination.tongue-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2571 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTongueExamination\\Http\\Controllers\\TongueExaminationController@show',
    'permission' => 'medical-record-tongue-examination.tongue-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2572 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTongueExamination\\Http\\Controllers\\TongueExaminationController@store',
    'permission' => 'medical-record-tongue-examination.tongue-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2573 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTongueExamination\\Http\\Controllers\\TongueExaminationController@update',
    'permission' => 'medical-record-tongue-examination.tongue-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2574 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTongueExamination\\Http\\Controllers\\TongueExaminationController@destroy',
    'permission' => 'medical-record-tongue-examination.tongue-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2575 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTonsilExamination\\Http\\Controllers\\TonsilExaminationController@index',
    'permission' => 'medical-record-tonsil-examination.tonsil-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2576 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTonsilExamination\\Http\\Controllers\\TonsilExaminationController@show',
    'permission' => 'medical-record-tonsil-examination.tonsil-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2577 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTonsilExamination\\Http\\Controllers\\TonsilExaminationController@store',
    'permission' => 'medical-record-tonsil-examination.tonsil-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2578 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTonsilExamination\\Http\\Controllers\\TonsilExaminationController@update',
    'permission' => 'medical-record-tonsil-examination.tonsil-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2579 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTonsilExamination\\Http\\Controllers\\TonsilExaminationController@destroy',
    'permission' => 'medical-record-tonsil-examination.tonsil-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2580 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTranscranialDopplerExamination\\Http\\Controllers\\TranscranialDopplerExaminationController@index',
    'permission' => 'medical-record-transcranial-doppler-examination.transcranial-doppler-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2581 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTranscranialDopplerExamination\\Http\\Controllers\\TranscranialDopplerExaminationController@show',
    'permission' => 'medical-record-transcranial-doppler-examination.transcranial-doppler-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2582 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTranscranialDopplerExamination\\Http\\Controllers\\TranscranialDopplerExaminationController@store',
    'permission' => 'medical-record-transcranial-doppler-examination.transcranial-doppler-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2583 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTranscranialDopplerExamination\\Http\\Controllers\\TranscranialDopplerExaminationController@update',
    'permission' => 'medical-record-transcranial-doppler-examination.transcranial-doppler-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2584 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTranscranialDopplerExamination\\Http\\Controllers\\TranscranialDopplerExaminationController@destroy',
    'permission' => 'medical-record-transcranial-doppler-examination.transcranial-doppler-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2585 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTranscranialDopplerWindow\\Http\\Controllers\\TranscranialDopplerWindowController@index',
    'permission' => 'medical-record-transcranial-doppler-window.transcranial-doppler-window.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2586 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTranscranialDopplerWindow\\Http\\Controllers\\TranscranialDopplerWindowController@show',
    'permission' => 'medical-record-transcranial-doppler-window.transcranial-doppler-window.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2587 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTranscranialDopplerWindow\\Http\\Controllers\\TranscranialDopplerWindowController@store',
    'permission' => 'medical-record-transcranial-doppler-window.transcranial-doppler-window.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2588 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTranscranialDopplerWindow\\Http\\Controllers\\TranscranialDopplerWindowController@update',
    'permission' => 'medical-record-transcranial-doppler-window.transcranial-doppler-window.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2589 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTranscranialDopplerWindow\\Http\\Controllers\\TranscranialDopplerWindowController@destroy',
    'permission' => 'medical-record-transcranial-doppler-window.transcranial-doppler-window.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2590 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTransferMedicationReconciliation\\Http\\Controllers\\TransferMedicationReconciliationController@index',
    'permission' => 'medical-record-transfer-medication-reconciliation.transfer-medication-reconciliation.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2591 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTransferMedicationReconciliation\\Http\\Controllers\\TransferMedicationReconciliationController@show',
    'permission' => 'medical-record-transfer-medication-reconciliation.transfer-medication-reconciliation.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2592 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTransferMedicationReconciliation\\Http\\Controllers\\TransferMedicationReconciliationController@store',
    'permission' => 'medical-record-transfer-medication-reconciliation.transfer-medication-reconciliation.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2593 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTransferMedicationReconciliation\\Http\\Controllers\\TransferMedicationReconciliationController@update',
    'permission' => 'medical-record-transfer-medication-reconciliation.transfer-medication-reconciliation.update',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2594 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTransferMedicationReconciliationItem\\Http\\Controllers\\TransferMedicationReconciliationItemController@index',
    'permission' => 'medical-record-transfer-medication-reconciliation-item.transfer-medication-reconciliation-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2595 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTransferMedicationReconciliationItem\\Http\\Controllers\\TransferMedicationReconciliationItemController@show',
    'permission' => 'medical-record-transfer-medication-reconciliation-item.transfer-medication-reconciliation-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2596 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTransferMedicationReconciliationItem\\Http\\Controllers\\TransferMedicationReconciliationItemController@store',
    'permission' => 'medical-record-transfer-medication-reconciliation-item.transfer-medication-reconciliation-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2597 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTreatmentHistory\\Http\\Controllers\\TreatmentHistoryController@index',
    'permission' => 'medical-record-treatment-history.treatment-history.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2598 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTreatmentHistory\\Http\\Controllers\\TreatmentHistoryController@show',
    'permission' => 'medical-record-treatment-history.treatment-history.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2599 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTreatmentHistory\\Http\\Controllers\\TreatmentHistoryController@store',
    'permission' => 'medical-record-treatment-history.treatment-history.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2600 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTriage\\Http\\Controllers\\TriageController@index',
    'permission' => 'medical-record-triage.triage.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2601 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTriage\\Http\\Controllers\\TriageController@show',
    'permission' => 'medical-record-triage.triage.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2602 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTriage\\Http\\Controllers\\TriageController@store',
    'permission' => 'medical-record-triage.triage.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2603 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTumorAssessment\\Http\\Controllers\\TumorAssessmentController@index',
    'permission' => 'medical-record-tumor-assessment.tumor-assessment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2604 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTumorAssessment\\Http\\Controllers\\TumorAssessmentController@show',
    'permission' => 'medical-record-tumor-assessment.tumor-assessment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2605 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordTumorAssessment\\Http\\Controllers\\TumorAssessmentController@store',
    'permission' => 'medical-record-tumor-assessment.tumor-assessment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2606 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordUltrasoundGuidedProcedure\\Http\\Controllers\\UltrasoundGuidedProcedureController@index',
    'permission' => 'medical-record-ultrasound-guided-procedure.ultrasound-guided-procedure.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2607 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordUltrasoundGuidedProcedure\\Http\\Controllers\\UltrasoundGuidedProcedureController@show',
    'permission' => 'medical-record-ultrasound-guided-procedure.ultrasound-guided-procedure.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2608 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordUltrasoundGuidedProcedure\\Http\\Controllers\\UltrasoundGuidedProcedureController@store',
    'permission' => 'medical-record-ultrasound-guided-procedure.ultrasound-guided-procedure.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2609 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordUltrasoundGuidedProcedure\\Http\\Controllers\\UltrasoundGuidedProcedureController@update',
    'permission' => 'medical-record-ultrasound-guided-procedure.ultrasound-guided-procedure.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2610 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordUltrasoundGuidedProcedure\\Http\\Controllers\\UltrasoundGuidedProcedureController@destroy',
    'permission' => 'medical-record-ultrasound-guided-procedure.ultrasound-guided-procedure.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2611 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordUpperArmExamination\\Http\\Controllers\\UpperArmExaminationController@index',
    'permission' => 'medical-record-upper-arm-examination.upper-arm-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2612 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordUpperArmExamination\\Http\\Controllers\\UpperArmExaminationController@show',
    'permission' => 'medical-record-upper-arm-examination.upper-arm-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2613 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordUpperArmExamination\\Http\\Controllers\\UpperArmExaminationController@store',
    'permission' => 'medical-record-upper-arm-examination.upper-arm-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2614 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordUpperArmExamination\\Http\\Controllers\\UpperArmExaminationController@update',
    'permission' => 'medical-record-upper-arm-examination.upper-arm-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2615 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordUpperArmExamination\\Http\\Controllers\\UpperArmExaminationController@destroy',
    'permission' => 'medical-record-upper-arm-examination.upper-arm-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2616 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordUpperGiTractExamination\\Http\\Controllers\\UpperGiTractExaminationController@index',
    'permission' => 'medical-record-upper-gi-tract-examination.upper-gi-tract-examination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2617 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordUpperGiTractExamination\\Http\\Controllers\\UpperGiTractExaminationController@show',
    'permission' => 'medical-record-upper-gi-tract-examination.upper-gi-tract-examination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2618 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordUpperGiTractExamination\\Http\\Controllers\\UpperGiTractExaminationController@store',
    'permission' => 'medical-record-upper-gi-tract-examination.upper-gi-tract-examination.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2619 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordUpperGiTractExamination\\Http\\Controllers\\UpperGiTractExaminationController@update',
    'permission' => 'medical-record-upper-gi-tract-examination.upper-gi-tract-examination.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2620 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordUpperGiTractExamination\\Http\\Controllers\\UpperGiTractExaminationController@destroy',
    'permission' => 'medical-record-upper-gi-tract-examination.upper-gi-tract-examination.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2621 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordVitalSign\\Http\\Controllers\\VitalSignController@index',
    'permission' => 'medical-record-vital-sign.vital-sign.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2622 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordVitalSign\\Http\\Controllers\\VitalSignController@show',
    'permission' => 'medical-record-vital-sign.vital-sign.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2623 => 
  array (
    'controller_action' => 'Modules\\MedicalRecordVitalSign\\Http\\Controllers\\VitalSignController@store',
    'permission' => 'medical-record-vital-sign.vital-sign.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2624 => 
  array (
    'controller_action' => 'Modules\\PasienPatientPortalAccount\\Http\\Controllers\\PatientPortalAccountController@index',
    'permission' => 'pasien-patient-portal-account.patient-portal-account.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2625 => 
  array (
    'controller_action' => 'Modules\\PasienPatientPortalAccount\\Http\\Controllers\\PatientPortalAccountController@show',
    'permission' => 'pasien-patient-portal-account.patient-portal-account.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2626 => 
  array (
    'controller_action' => 'Modules\\PasienPatientPortalAccount\\Http\\Controllers\\PatientPortalAccountController@store',
    'permission' => 'pasien-patient-portal-account.patient-portal-account.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2627 => 
  array (
    'controller_action' => 'Modules\\PasienPatientPortalAccount\\Http\\Controllers\\PatientPortalAccountController@update',
    'permission' => 'pasien-patient-portal-account.patient-portal-account.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2628 => 
  array (
    'controller_action' => 'Modules\\PasienPatientPortalAccount\\Http\\Controllers\\PatientPortalAccountController@destroy',
    'permission' => 'pasien-patient-portal-account.patient-portal-account.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2629 => 
  array (
    'controller_action' => 'Modules\\PegawaiEmployeeContact\\Http\\Controllers\\EmployeeContactController@index',
    'permission' => 'pegawai-employee-contact.employee-contact.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2630 => 
  array (
    'controller_action' => 'Modules\\PegawaiEmployeeContact\\Http\\Controllers\\EmployeeContactController@show',
    'permission' => 'pegawai-employee-contact.employee-contact.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2631 => 
  array (
    'controller_action' => 'Modules\\PegawaiEmployeeContact\\Http\\Controllers\\EmployeeContactController@store',
    'permission' => 'pegawai-employee-contact.employee-contact.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2632 => 
  array (
    'controller_action' => 'Modules\\PegawaiEmployeeContact\\Http\\Controllers\\EmployeeContactController@update',
    'permission' => 'pegawai-employee-contact.employee-contact.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2633 => 
  array (
    'controller_action' => 'Modules\\PegawaiEmployeeContact\\Http\\Controllers\\EmployeeContactController@destroy',
    'permission' => 'pegawai-employee-contact.employee-contact.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2634 => 
  array (
    'controller_action' => 'Modules\\PegawaiEmployeeIdentityCard\\Http\\Controllers\\EmployeeIdentityCardController@index',
    'permission' => 'pegawai-employee-identity-card.employee-identity-card.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2635 => 
  array (
    'controller_action' => 'Modules\\PegawaiEmployeeIdentityCard\\Http\\Controllers\\EmployeeIdentityCardController@show',
    'permission' => 'pegawai-employee-identity-card.employee-identity-card.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2636 => 
  array (
    'controller_action' => 'Modules\\PegawaiEmployeeIdentityCard\\Http\\Controllers\\EmployeeIdentityCardController@store',
    'permission' => 'pegawai-employee-identity-card.employee-identity-card.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2637 => 
  array (
    'controller_action' => 'Modules\\PegawaiEmployeeIdentityCard\\Http\\Controllers\\EmployeeIdentityCardController@update',
    'permission' => 'pegawai-employee-identity-card.employee-identity-card.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2638 => 
  array (
    'controller_action' => 'Modules\\PegawaiEmployeeIdentityCard\\Http\\Controllers\\EmployeeIdentityCardController@destroy',
    'permission' => 'pegawai-employee-identity-card.employee-identity-card.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2639 => 
  array (
    'controller_action' => 'Modules\\PegawaiJadwalShift\\Http\\Controllers\\ShiftScheduleController@index',
    'permission' => 'pegawai-jadwal-shift.shift-schedule.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2640 => 
  array (
    'controller_action' => 'Modules\\PegawaiJadwalShift\\Http\\Controllers\\ShiftScheduleController@show',
    'permission' => 'pegawai-jadwal-shift.shift-schedule.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2641 => 
  array (
    'controller_action' => 'Modules\\PegawaiJadwalShift\\Http\\Controllers\\ShiftScheduleController@byWardAndDateRange',
    'permission' => 'pegawai-jadwal-shift.shift-schedule.by-ward-and-date-range',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2642 => 
  array (
    'controller_action' => 'Modules\\PegawaiJadwalShift\\Http\\Controllers\\ShiftScheduleController@store',
    'permission' => 'pegawai-jadwal-shift.shift-schedule.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2643 => 
  array (
    'controller_action' => 'Modules\\PegawaiJadwalShift\\Http\\Controllers\\ShiftScheduleController@update',
    'permission' => 'pegawai-jadwal-shift.shift-schedule.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2644 => 
  array (
    'controller_action' => 'Modules\\PegawaiJadwalShift\\Http\\Controllers\\ShiftScheduleController@destroy',
    'permission' => 'pegawai-jadwal-shift.shift-schedule.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2645 => 
  array (
    'controller_action' => 'Modules\\PegawaiPracticeLicense\\Http\\Controllers\\PracticeLicenseController@index',
    'permission' => 'pegawai-practice-license.practice-license.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2646 => 
  array (
    'controller_action' => 'Modules\\PegawaiPracticeLicense\\Http\\Controllers\\PracticeLicenseController@show',
    'permission' => 'pegawai-practice-license.practice-license.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2647 => 
  array (
    'controller_action' => 'Modules\\PegawaiPracticeLicense\\Http\\Controllers\\PracticeLicenseController@store',
    'permission' => 'pegawai-practice-license.practice-license.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2648 => 
  array (
    'controller_action' => 'Modules\\PegawaiPracticeLicense\\Http\\Controllers\\PracticeLicenseController@update',
    'permission' => 'pegawai-practice-license.practice-license.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2649 => 
  array (
    'controller_action' => 'Modules\\PegawaiRemunerasiJasaMedis\\Http\\Controllers\\RemunerationEntryController@summary',
    'permission' => 'pegawai-remunerasi-jasa-medis.remuneration-entry.summary',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2650 => 
  array (
    'controller_action' => 'Modules\\PegawaiRemunerasiJasaMedis\\Http\\Controllers\\RemunerationEntryController@index',
    'permission' => 'pegawai-remunerasi-jasa-medis.remuneration-entry.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2651 => 
  array (
    'controller_action' => 'Modules\\PegawaiRemunerasiJasaMedis\\Http\\Controllers\\RemunerationEntryController@show',
    'permission' => 'pegawai-remunerasi-jasa-medis.remuneration-entry.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2652 => 
  array (
    'controller_action' => 'Modules\\PegawaiRemunerasiJasaMedis\\Http\\Controllers\\RemunerationEntryController@store',
    'permission' => 'pegawai-remunerasi-jasa-medis.remuneration-entry.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2653 => 
  array (
    'controller_action' => 'Modules\\PegawaiRemunerasiJasaMedis\\Http\\Controllers\\RemunerationEntryController@update',
    'permission' => 'pegawai-remunerasi-jasa-medis.remuneration-entry.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2654 => 
  array (
    'controller_action' => 'Modules\\PegawaiRemunerasiJasaMedis\\Http\\Controllers\\RemunerationEntryController@destroy',
    'permission' => 'pegawai-remunerasi-jasa-medis.remuneration-entry.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2655 => 
  array (
    'controller_action' => 'Modules\\PembatalanDocumentCancellation\\Http\\Controllers\\PembatalanDocumentCancellationController@index',
    'permission' => 'pembatalan-document-cancellation.pembatalan-document-cancellation.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2656 => 
  array (
    'controller_action' => 'Modules\\PembatalanDocumentCancellation\\Http\\Controllers\\PembatalanDocumentCancellationController@show',
    'permission' => 'pembatalan-document-cancellation.pembatalan-document-cancellation.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2657 => 
  array (
    'controller_action' => 'Modules\\PembatalanDocumentCancellation\\Http\\Controllers\\PembatalanDocumentCancellationController@store',
    'permission' => 'pembatalan-document-cancellation.pembatalan-document-cancellation.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2658 => 
  array (
    'controller_action' => 'Modules\\PembatalanDocumentCancellation\\Http\\Controllers\\PembatalanDocumentCancellationController@update',
    'permission' => 'pembatalan-document-cancellation.pembatalan-document-cancellation.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2659 => 
  array (
    'controller_action' => 'Modules\\PembatalanDocumentCancellation\\Http\\Controllers\\PembatalanDocumentCancellationController@destroy',
    'permission' => 'pembatalan-document-cancellation.pembatalan-document-cancellation.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2660 => 
  array (
    'controller_action' => 'Modules\\PembatalanFinalResult\\Http\\Controllers\\PembatalanFinalResultController@index',
    'permission' => 'pembatalan-final-result.pembatalan-final-result.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2661 => 
  array (
    'controller_action' => 'Modules\\PembatalanFinalResult\\Http\\Controllers\\PembatalanFinalResultController@show',
    'permission' => 'pembatalan-final-result.pembatalan-final-result.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2662 => 
  array (
    'controller_action' => 'Modules\\PembatalanFinalResult\\Http\\Controllers\\PembatalanFinalResultController@store',
    'permission' => 'pembatalan-final-result.pembatalan-final-result.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2663 => 
  array (
    'controller_action' => 'Modules\\PembatalanFinalResult\\Http\\Controllers\\PembatalanFinalResultController@update',
    'permission' => 'pembatalan-final-result.pembatalan-final-result.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2664 => 
  array (
    'controller_action' => 'Modules\\PembatalanFinalResult\\Http\\Controllers\\PembatalanFinalResultController@destroy',
    'permission' => 'pembatalan-final-result.pembatalan-final-result.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2665 => 
  array (
    'controller_action' => 'Modules\\PembatalanMedicalRecordCancellation\\Http\\Controllers\\PembatalanMedicalRecordCancellationController@index',
    'permission' => 'pembatalan-medical-record-cancellation.pembatalan-medical-record-cancellation.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2666 => 
  array (
    'controller_action' => 'Modules\\PembatalanMedicalRecordCancellation\\Http\\Controllers\\PembatalanMedicalRecordCancellationController@show',
    'permission' => 'pembatalan-medical-record-cancellation.pembatalan-medical-record-cancellation.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2667 => 
  array (
    'controller_action' => 'Modules\\PembatalanMedicalRecordCancellation\\Http\\Controllers\\PembatalanMedicalRecordCancellationController@store',
    'permission' => 'pembatalan-medical-record-cancellation.pembatalan-medical-record-cancellation.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2668 => 
  array (
    'controller_action' => 'Modules\\PembatalanMedicalRecordCancellation\\Http\\Controllers\\PembatalanMedicalRecordCancellationController@update',
    'permission' => 'pembatalan-medical-record-cancellation.pembatalan-medical-record-cancellation.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2669 => 
  array (
    'controller_action' => 'Modules\\PembatalanMedicalRecordCancellation\\Http\\Controllers\\PembatalanMedicalRecordCancellationController@destroy',
    'permission' => 'pembatalan-medical-record-cancellation.pembatalan-medical-record-cancellation.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2670 => 
  array (
    'controller_action' => 'Modules\\PembatalanReturnCancellation\\Http\\Controllers\\PembatalanReturnCancellationController@index',
    'permission' => 'pembatalan-return-cancellation.pembatalan-return-cancellation.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2671 => 
  array (
    'controller_action' => 'Modules\\PembatalanReturnCancellation\\Http\\Controllers\\PembatalanReturnCancellationController@show',
    'permission' => 'pembatalan-return-cancellation.pembatalan-return-cancellation.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2672 => 
  array (
    'controller_action' => 'Modules\\PembatalanReturnCancellation\\Http\\Controllers\\PembatalanReturnCancellationController@store',
    'permission' => 'pembatalan-return-cancellation.pembatalan-return-cancellation.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2673 => 
  array (
    'controller_action' => 'Modules\\PembatalanReturnCancellation\\Http\\Controllers\\PembatalanReturnCancellationController@update',
    'permission' => 'pembatalan-return-cancellation.pembatalan-return-cancellation.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2674 => 
  array (
    'controller_action' => 'Modules\\PembatalanReturnCancellation\\Http\\Controllers\\PembatalanReturnCancellationController@destroy',
    'permission' => 'pembatalan-return-cancellation.pembatalan-return-cancellation.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2675 => 
  array (
    'controller_action' => 'Modules\\PembatalanVisitCancellation\\Http\\Controllers\\VisitCancellationController@index',
    'permission' => 'pembatalan-visit-cancellation.visit-cancellation.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2676 => 
  array (
    'controller_action' => 'Modules\\PembatalanVisitCancellation\\Http\\Controllers\\VisitCancellationController@show',
    'permission' => 'pembatalan-visit-cancellation.visit-cancellation.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2677 => 
  array (
    'controller_action' => 'Modules\\PembatalanVisitCancellation\\Http\\Controllers\\VisitCancellationController@store',
    'permission' => 'pembatalan-visit-cancellation.visit-cancellation.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2678 => 
  array (
    'controller_action' => 'Modules\\PembayaranCashier\\Http\\Controllers\\CashierController@index',
    'permission' => 'pembayaran-cashier.cashier.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2679 => 
  array (
    'controller_action' => 'Modules\\PembayaranCashier\\Http\\Controllers\\CashierController@show',
    'permission' => 'pembayaran-cashier.cashier.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2680 => 
  array (
    'controller_action' => 'Modules\\PembayaranCashier\\Http\\Controllers\\CashierController@store',
    'permission' => 'pembayaran-cashier.cashier.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2681 => 
  array (
    'controller_action' => 'Modules\\PembayaranCashier\\Http\\Controllers\\CashierController@update',
    'permission' => 'pembayaran-cashier.cashier.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2682 => 
  array (
    'controller_action' => 'Modules\\PembayaranCashier\\Http\\Controllers\\CashierController@destroy',
    'permission' => 'pembayaran-cashier.cashier.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2683 => 
  array (
    'controller_action' => 'Modules\\PembayaranCashierShift\\Http\\Controllers\\CashierShiftController@index',
    'permission' => 'pembayaran-cashier-shift.cashier-shift.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2684 => 
  array (
    'controller_action' => 'Modules\\PembayaranCashierShift\\Http\\Controllers\\CashierShiftController@open',
    'permission' => 'pembayaran-cashier-shift.cashier-shift.open',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2685 => 
  array (
    'controller_action' => 'Modules\\PembayaranCashierShift\\Http\\Controllers\\CashierShiftController@close',
    'permission' => 'pembayaran-cashier-shift.cashier-shift.close',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2686 => 
  array (
    'controller_action' => 'Modules\\PembayaranCashierTransaction\\Http\\Controllers\\CashierTransactionController@index',
    'permission' => 'pembayaran-cashier-transaction.cashier-transaction.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2687 => 
  array (
    'controller_action' => 'Modules\\PembayaranCashierTransaction\\Http\\Controllers\\CashierTransactionController@show',
    'permission' => 'pembayaran-cashier-transaction.cashier-transaction.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2688 => 
  array (
    'controller_action' => 'Modules\\PembayaranCashierTransaction\\Http\\Controllers\\CashierTransactionController@store',
    'permission' => 'pembayaran-cashier-transaction.cashier-transaction.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2689 => 
  array (
    'controller_action' => 'Modules\\PembayaranClaimInvoice\\Http\\Controllers\\ClaimInvoiceController@index',
    'permission' => 'pembayaran-claim-invoice.claim-invoice.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2690 => 
  array (
    'controller_action' => 'Modules\\PembayaranClaimInvoice\\Http\\Controllers\\ClaimInvoiceController@show',
    'permission' => 'pembayaran-claim-invoice.claim-invoice.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2691 => 
  array (
    'controller_action' => 'Modules\\PembayaranClaimInvoice\\Http\\Controllers\\ClaimInvoiceController@store',
    'permission' => 'pembayaran-claim-invoice.claim-invoice.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2692 => 
  array (
    'controller_action' => 'Modules\\PembayaranClaimInvoice\\Http\\Controllers\\ClaimInvoiceController@update',
    'permission' => 'pembayaran-claim-invoice.claim-invoice.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2693 => 
  array (
    'controller_action' => 'Modules\\PembayaranClaimInvoice\\Http\\Controllers\\ClaimInvoiceController@destroy',
    'permission' => 'pembayaran-claim-invoice.claim-invoice.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2694 => 
  array (
    'controller_action' => 'Modules\\PembayaranClaimInvoice\\Http\\Controllers\\ClaimInvoiceController@transition',
    'permission' => 'pembayaran-claim-invoice.claim-invoice.transition',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2695 => 
  array (
    'controller_action' => 'Modules\\PembayaranCorporateReceivable\\Http\\Controllers\\CorporateReceivableController@index',
    'permission' => 'pembayaran-corporate-receivable.corporate-receivable.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2696 => 
  array (
    'controller_action' => 'Modules\\PembayaranCorporateReceivable\\Http\\Controllers\\CorporateReceivableController@show',
    'permission' => 'pembayaran-corporate-receivable.corporate-receivable.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2697 => 
  array (
    'controller_action' => 'Modules\\PembayaranCorporateReceivable\\Http\\Controllers\\CorporateReceivableController@store',
    'permission' => 'pembayaran-corporate-receivable.corporate-receivable.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2698 => 
  array (
    'controller_action' => 'Modules\\PembayaranCorporateReceivable\\Http\\Controllers\\CorporateReceivableController@transition',
    'permission' => 'pembayaran-corporate-receivable.corporate-receivable.transition',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2699 => 
  array (
    'controller_action' => 'Modules\\PembayaranCorporateReceivableSettlement\\Http\\Controllers\\CorporateReceivableSettlementController@index',
    'permission' => 'pembayaran-corporate-receivable-settlement.corporate-receivable-settlement.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2700 => 
  array (
    'controller_action' => 'Modules\\PembayaranCorporateReceivableSettlement\\Http\\Controllers\\CorporateReceivableSettlementController@show',
    'permission' => 'pembayaran-corporate-receivable-settlement.corporate-receivable-settlement.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2701 => 
  array (
    'controller_action' => 'Modules\\PembayaranCorporateReceivableSettlement\\Http\\Controllers\\CorporateReceivableSettlementController@store',
    'permission' => 'pembayaran-corporate-receivable-settlement.corporate-receivable-settlement.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2702 => 
  array (
    'controller_action' => 'Modules\\PembayaranDeposit\\Http\\Controllers\\DepositController@index',
    'permission' => 'pembayaran-deposit.deposit.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2703 => 
  array (
    'controller_action' => 'Modules\\PembayaranDeposit\\Http\\Controllers\\DepositController@show',
    'permission' => 'pembayaran-deposit.deposit.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2704 => 
  array (
    'controller_action' => 'Modules\\PembayaranDeposit\\Http\\Controllers\\DepositController@store',
    'permission' => 'pembayaran-deposit.deposit.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2705 => 
  array (
    'controller_action' => 'Modules\\PembayaranDeposit\\Http\\Controllers\\DepositController@update',
    'permission' => 'pembayaran-deposit.deposit.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2706 => 
  array (
    'controller_action' => 'Modules\\PembayaranDepositRefund\\Http\\Controllers\\DepositRefundController@index',
    'permission' => 'pembayaran-deposit-refund.deposit-refund.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2707 => 
  array (
    'controller_action' => 'Modules\\PembayaranDepositRefund\\Http\\Controllers\\DepositRefundController@show',
    'permission' => 'pembayaran-deposit-refund.deposit-refund.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2708 => 
  array (
    'controller_action' => 'Modules\\PembayaranDepositRefund\\Http\\Controllers\\DepositRefundController@store',
    'permission' => 'pembayaran-deposit-refund.deposit-refund.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2709 => 
  array (
    'controller_action' => 'Modules\\PembayaranDiscount\\Http\\Controllers\\DiscountController@index',
    'permission' => 'pembayaran-discount.discount.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2710 => 
  array (
    'controller_action' => 'Modules\\PembayaranDiscount\\Http\\Controllers\\DiscountController@show',
    'permission' => 'pembayaran-discount.discount.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2711 => 
  array (
    'controller_action' => 'Modules\\PembayaranDiscount\\Http\\Controllers\\DiscountController@store',
    'permission' => 'pembayaran-discount.discount.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2712 => 
  array (
    'controller_action' => 'Modules\\PembayaranDiscount\\Http\\Controllers\\DiscountController@update',
    'permission' => 'pembayaran-discount.discount.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2713 => 
  array (
    'controller_action' => 'Modules\\PembayaranDiscount\\Http\\Controllers\\DiscountController@destroy',
    'permission' => 'pembayaran-discount.discount.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2714 => 
  array (
    'controller_action' => 'Modules\\PembayaranDoctorDiscount\\Http\\Controllers\\DoctorDiscountController@index',
    'permission' => 'pembayaran-doctor-discount.doctor-discount.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2715 => 
  array (
    'controller_action' => 'Modules\\PembayaranDoctorDiscount\\Http\\Controllers\\DoctorDiscountController@show',
    'permission' => 'pembayaran-doctor-discount.doctor-discount.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2716 => 
  array (
    'controller_action' => 'Modules\\PembayaranDoctorDiscount\\Http\\Controllers\\DoctorDiscountController@store',
    'permission' => 'pembayaran-doctor-discount.doctor-discount.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2717 => 
  array (
    'controller_action' => 'Modules\\PembayaranDoctorDiscount\\Http\\Controllers\\DoctorDiscountController@update',
    'permission' => 'pembayaran-doctor-discount.doctor-discount.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2718 => 
  array (
    'controller_action' => 'Modules\\PembayaranDoctorDiscount\\Http\\Controllers\\DoctorDiscountController@destroy',
    'permission' => 'pembayaran-doctor-discount.doctor-discount.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2719 => 
  array (
    'controller_action' => 'Modules\\PembayaranEdc\\Http\\Controllers\\EdcController@index',
    'permission' => 'pembayaran-edc.edc.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2720 => 
  array (
    'controller_action' => 'Modules\\PembayaranEdc\\Http\\Controllers\\EdcController@show',
    'permission' => 'pembayaran-edc.edc.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2721 => 
  array (
    'controller_action' => 'Modules\\PembayaranEdc\\Http\\Controllers\\EdcController@store',
    'permission' => 'pembayaran-edc.edc.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2722 => 
  array (
    'controller_action' => 'Modules\\PembayaranEdc\\Http\\Controllers\\EdcController@update',
    'permission' => 'pembayaran-edc.edc.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2723 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoice\\Http\\Controllers\\InvoiceController@index',
    'permission' => 'pembayaran-invoice.invoice.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2724 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoice\\Http\\Controllers\\InvoiceController@store',
    'permission' => 'pembayaran-invoice.invoice.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2725 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoice\\Http\\Controllers\\InvoiceController@show',
    'permission' => 'pembayaran-invoice.invoice.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2726 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoice\\Http\\Controllers\\InvoiceController@update',
    'permission' => 'pembayaran-invoice.invoice.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2727 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoice\\Http\\Controllers\\InvoiceController@destroy',
    'permission' => 'pembayaran-invoice.invoice.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2728 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoice\\Http\\Controllers\\InvoiceGuarantorController@index',
    'permission' => 'pembayaran-invoice.invoice-guarantor.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2729 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoice\\Http\\Controllers\\InvoiceGuarantorController@coverage',
    'permission' => 'pembayaran-invoice.invoice-guarantor.coverage',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2730 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoice\\Http\\Controllers\\InvoiceGuarantorController@store',
    'permission' => 'pembayaran-invoice.invoice-guarantor.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2731 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoice\\Http\\Controllers\\InvoiceGuarantorController@redistribute',
    'permission' => 'pembayaran-invoice.invoice-guarantor.redistribute',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2732 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoice\\Http\\Controllers\\InvoiceGuarantorController@lock',
    'permission' => 'pembayaran-invoice.invoice-guarantor.lock',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2733 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoice\\Http\\Controllers\\InvoiceGuarantorController@unlock',
    'permission' => 'pembayaran-invoice.invoice-guarantor.unlock',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  2734 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceCancellation\\Http\\Controllers\\InvoiceCancellationController@index',
    'permission' => 'pembayaran-invoice-cancellation.invoice-cancellation.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2735 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceCancellation\\Http\\Controllers\\InvoiceCancellationController@show',
    'permission' => 'pembayaran-invoice-cancellation.invoice-cancellation.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2736 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceCancellation\\Http\\Controllers\\InvoiceCancellationController@store',
    'permission' => 'pembayaran-invoice-cancellation.invoice-cancellation.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2737 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceGuarantor\\Http\\Controllers\\InvoiceGuarantorController@index',
    'permission' => 'pembayaran-invoice-guarantor.invoice-guarantor.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2738 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceGuarantor\\Http\\Controllers\\InvoiceGuarantorController@show',
    'permission' => 'pembayaran-invoice-guarantor.invoice-guarantor.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2739 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceGuarantor\\Http\\Controllers\\InvoiceGuarantorController@store',
    'permission' => 'pembayaran-invoice-guarantor.invoice-guarantor.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2740 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceGuarantor\\Http\\Controllers\\InvoiceGuarantorController@update',
    'permission' => 'pembayaran-invoice-guarantor.invoice-guarantor.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2741 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceGuarantor\\Http\\Controllers\\InvoiceGuarantorController@destroy',
    'permission' => 'pembayaran-invoice-guarantor.invoice-guarantor.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2742 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceItem\\Http\\Controllers\\InvoiceItemController@index',
    'permission' => 'pembayaran-invoice-item.invoice-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2743 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceItem\\Http\\Controllers\\InvoiceItemController@store',
    'permission' => 'pembayaran-invoice-item.invoice-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2744 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceItem\\Http\\Controllers\\InvoiceItemController@show',
    'permission' => 'pembayaran-invoice-item.invoice-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2745 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceItem\\Http\\Controllers\\InvoiceItemController@update',
    'permission' => 'pembayaran-invoice-item.invoice-item.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2746 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceItem\\Http\\Controllers\\InvoiceItemController@destroy',
    'permission' => 'pembayaran-invoice-item.invoice-item.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2747 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceMerge\\Http\\Controllers\\InvoiceMergeController@index',
    'permission' => 'pembayaran-invoice-merge.invoice-merge.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2748 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceMerge\\Http\\Controllers\\InvoiceMergeController@show',
    'permission' => 'pembayaran-invoice-merge.invoice-merge.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2749 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceMerge\\Http\\Controllers\\InvoiceMergeController@store',
    'permission' => 'pembayaran-invoice-merge.invoice-merge.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2750 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceMerge\\Http\\Controllers\\InvoiceMergeController@update',
    'permission' => 'pembayaran-invoice-merge.invoice-merge.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2751 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceMerge\\Http\\Controllers\\InvoiceMergeController@destroy',
    'permission' => 'pembayaran-invoice-merge.invoice-merge.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2752 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceSubsidy\\Http\\Controllers\\InvoiceSubsidyController@index',
    'permission' => 'pembayaran-invoice-subsidy.invoice-subsidy.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2753 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceSubsidy\\Http\\Controllers\\InvoiceSubsidyController@show',
    'permission' => 'pembayaran-invoice-subsidy.invoice-subsidy.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2754 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceSubsidy\\Http\\Controllers\\InvoiceSubsidyController@store',
    'permission' => 'pembayaran-invoice-subsidy.invoice-subsidy.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2755 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceSubsidy\\Http\\Controllers\\InvoiceSubsidyController@update',
    'permission' => 'pembayaran-invoice-subsidy.invoice-subsidy.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2756 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceSubsidy\\Http\\Controllers\\InvoiceSubsidyController@destroy',
    'permission' => 'pembayaran-invoice-subsidy.invoice-subsidy.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2757 => 
  array (
    'controller_action' => 'Modules\\PembayaranInvoiceSubsidy\\Http\\Controllers\\InvoiceSubsidyController@transition',
    'permission' => 'pembayaran-invoice-subsidy.invoice-subsidy.transition',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2758 => 
  array (
    'controller_action' => 'Modules\\PembayaranPackageInvoiceItem\\Http\\Controllers\\PackageInvoiceItemController@index',
    'permission' => 'pembayaran-package-invoice-item.package-invoice-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2759 => 
  array (
    'controller_action' => 'Modules\\PembayaranPackageInvoiceItem\\Http\\Controllers\\PackageInvoiceItemController@show',
    'permission' => 'pembayaran-package-invoice-item.package-invoice-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2760 => 
  array (
    'controller_action' => 'Modules\\PembayaranPackageInvoiceItem\\Http\\Controllers\\PackageInvoiceItemController@store',
    'permission' => 'pembayaran-package-invoice-item.package-invoice-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2761 => 
  array (
    'controller_action' => 'Modules\\PembayaranPackageInvoiceItem\\Http\\Controllers\\PackageInvoiceItemController@update',
    'permission' => 'pembayaran-package-invoice-item.package-invoice-item.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2762 => 
  array (
    'controller_action' => 'Modules\\PembayaranPackageInvoiceItem\\Http\\Controllers\\PackageInvoiceItemController@destroy',
    'permission' => 'pembayaran-package-invoice-item.package-invoice-item.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2763 => 
  array (
    'controller_action' => 'Modules\\PembayaranPatientReceivable\\Http\\Controllers\\PatientReceivableController@index',
    'permission' => 'pembayaran-patient-receivable.patient-receivable.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2764 => 
  array (
    'controller_action' => 'Modules\\PembayaranPatientReceivable\\Http\\Controllers\\PatientReceivableController@show',
    'permission' => 'pembayaran-patient-receivable.patient-receivable.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2765 => 
  array (
    'controller_action' => 'Modules\\PembayaranPatientReceivable\\Http\\Controllers\\PatientReceivableController@store',
    'permission' => 'pembayaran-patient-receivable.patient-receivable.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2766 => 
  array (
    'controller_action' => 'Modules\\PembayaranPatientReceivable\\Http\\Controllers\\PatientReceivableController@transition',
    'permission' => 'pembayaran-patient-receivable.patient-receivable.transition',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2767 => 
  array (
    'controller_action' => 'Modules\\PembayaranPatientReceivableSettlement\\Http\\Controllers\\PatientReceivableSettlementController@index',
    'permission' => 'pembayaran-patient-receivable-settlement.patient-receivable-settlement.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2768 => 
  array (
    'controller_action' => 'Modules\\PembayaranPatientReceivableSettlement\\Http\\Controllers\\PatientReceivableSettlementController@show',
    'permission' => 'pembayaran-patient-receivable-settlement.patient-receivable-settlement.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2769 => 
  array (
    'controller_action' => 'Modules\\PembayaranPatientReceivableSettlement\\Http\\Controllers\\PatientReceivableSettlementController@store',
    'permission' => 'pembayaran-patient-receivable-settlement.patient-receivable-settlement.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2770 => 
  array (
    'controller_action' => 'Modules\\PembayaranPayment\\Http\\Controllers\\PaymentController@index',
    'permission' => 'pembayaran-payment.payment.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2771 => 
  array (
    'controller_action' => 'Modules\\PembayaranPayment\\Http\\Controllers\\PaymentController@store',
    'permission' => 'pembayaran-payment.payment.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2772 => 
  array (
    'controller_action' => 'Modules\\PembayaranPayment\\Http\\Controllers\\PaymentController@show',
    'permission' => 'pembayaran-payment.payment.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2773 => 
  array (
    'controller_action' => 'Modules\\PembayaranPayment\\Http\\Controllers\\PaymentController@reverse',
    'permission' => 'pembayaran-payment.payment.reverse',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2774 => 
  array (
    'controller_action' => 'Modules\\PembayaranPaymentProvider\\Http\\Controllers\\PaymentProviderController@index',
    'permission' => 'pembayaran-payment-provider.payment-provider.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2775 => 
  array (
    'controller_action' => 'Modules\\PembayaranPaymentProvider\\Http\\Controllers\\PaymentProviderController@show',
    'permission' => 'pembayaran-payment-provider.payment-provider.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2776 => 
  array (
    'controller_action' => 'Modules\\PembayaranPaymentProvider\\Http\\Controllers\\PaymentProviderController@store',
    'permission' => 'pembayaran-payment-provider.payment-provider.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2777 => 
  array (
    'controller_action' => 'Modules\\PembayaranPaymentProvider\\Http\\Controllers\\PaymentProviderController@update',
    'permission' => 'pembayaran-payment-provider.payment-provider.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2778 => 
  array (
    'controller_action' => 'Modules\\PembayaranPaymentProvider\\Http\\Controllers\\PaymentProviderController@destroy',
    'permission' => 'pembayaran-payment-provider.payment-provider.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2779 => 
  array (
    'controller_action' => 'Modules\\PembayaranProviderService\\Http\\Controllers\\ProviderServiceController@index',
    'permission' => 'pembayaran-provider-service.provider-service.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2780 => 
  array (
    'controller_action' => 'Modules\\PembayaranProviderService\\Http\\Controllers\\ProviderServiceController@show',
    'permission' => 'pembayaran-provider-service.provider-service.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2781 => 
  array (
    'controller_action' => 'Modules\\PembayaranProviderService\\Http\\Controllers\\ProviderServiceController@store',
    'permission' => 'pembayaran-provider-service.provider-service.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2782 => 
  array (
    'controller_action' => 'Modules\\PembayaranProviderService\\Http\\Controllers\\ProviderServiceController@update',
    'permission' => 'pembayaran-provider-service.provider-service.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2783 => 
  array (
    'controller_action' => 'Modules\\PembayaranProviderService\\Http\\Controllers\\ProviderServiceController@destroy',
    'permission' => 'pembayaran-provider-service.provider-service.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2784 => 
  array (
    'controller_action' => 'Modules\\PembayaranRegistrationInvoice\\Http\\Controllers\\RegistrationInvoiceController@index',
    'permission' => 'pembayaran-registration-invoice.registration-invoice.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2785 => 
  array (
    'controller_action' => 'Modules\\PembayaranRegistrationInvoice\\Http\\Controllers\\RegistrationInvoiceController@show',
    'permission' => 'pembayaran-registration-invoice.registration-invoice.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2786 => 
  array (
    'controller_action' => 'Modules\\PembayaranRegistrationInvoice\\Http\\Controllers\\RegistrationInvoiceController@store',
    'permission' => 'pembayaran-registration-invoice.registration-invoice.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2787 => 
  array (
    'controller_action' => 'Modules\\PembayaranRegistrationInvoice\\Http\\Controllers\\RegistrationInvoiceController@update',
    'permission' => 'pembayaran-registration-invoice.registration-invoice.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2788 => 
  array (
    'controller_action' => 'Modules\\PembayaranRegistrationInvoice\\Http\\Controllers\\RegistrationInvoiceController@destroy',
    'permission' => 'pembayaran-registration-invoice.registration-invoice.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2789 => 
  array (
    'controller_action' => 'Modules\\PembayaranTransfer\\Http\\Controllers\\TransferController@index',
    'permission' => 'pembayaran-transfer.transfer.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2790 => 
  array (
    'controller_action' => 'Modules\\PembayaranTransfer\\Http\\Controllers\\TransferController@show',
    'permission' => 'pembayaran-transfer.transfer.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2791 => 
  array (
    'controller_action' => 'Modules\\PembayaranTransfer\\Http\\Controllers\\TransferController@store',
    'permission' => 'pembayaran-transfer.transfer.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2792 => 
  array (
    'controller_action' => 'Modules\\PembayaranTransfer\\Http\\Controllers\\TransferController@update',
    'permission' => 'pembayaran-transfer.transfer.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2793 => 
  array (
    'controller_action' => 'Modules\\PendaftaranAccidentRecord\\Http\\Controllers\\AccidentRecordController@index',
    'permission' => 'pendaftaran-accident-record.accident-record.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2794 => 
  array (
    'controller_action' => 'Modules\\PendaftaranAccidentRecord\\Http\\Controllers\\AccidentRecordController@show',
    'permission' => 'pendaftaran-accident-record.accident-record.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2795 => 
  array (
    'controller_action' => 'Modules\\PendaftaranAccidentRecord\\Http\\Controllers\\AccidentRecordController@store',
    'permission' => 'pendaftaran-accident-record.accident-record.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2796 => 
  array (
    'controller_action' => 'Modules\\PendaftaranApplicant\\Http\\Controllers\\ApplicantController@index',
    'permission' => 'pendaftaran-applicant.applicant.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2797 => 
  array (
    'controller_action' => 'Modules\\PendaftaranApplicant\\Http\\Controllers\\ApplicantController@show',
    'permission' => 'pendaftaran-applicant.applicant.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2798 => 
  array (
    'controller_action' => 'Modules\\PendaftaranApplicant\\Http\\Controllers\\ApplicantController@store',
    'permission' => 'pendaftaran-applicant.applicant.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2799 => 
  array (
    'controller_action' => 'Modules\\PendaftaranApplicant\\Http\\Controllers\\ApplicantController@update',
    'permission' => 'pendaftaran-applicant.applicant.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2800 => 
  array (
    'controller_action' => 'Modules\\PendaftaranApplicant\\Http\\Controllers\\ApplicantController@destroy',
    'permission' => 'pendaftaran-applicant.applicant.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2801 => 
  array (
    'controller_action' => 'Modules\\PendaftaranBedQueue\\Http\\Controllers\\BedQueueController@index',
    'permission' => 'pendaftaran-bed-queue.bed-queue.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2802 => 
  array (
    'controller_action' => 'Modules\\PendaftaranBedQueue\\Http\\Controllers\\BedQueueController@show',
    'permission' => 'pendaftaran-bed-queue.bed-queue.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2803 => 
  array (
    'controller_action' => 'Modules\\PendaftaranBedQueue\\Http\\Controllers\\BedQueueController@store',
    'permission' => 'pendaftaran-bed-queue.bed-queue.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2804 => 
  array (
    'controller_action' => 'Modules\\PendaftaranBedQueue\\Http\\Controllers\\BedQueueController@update',
    'permission' => 'pendaftaran-bed-queue.bed-queue.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2805 => 
  array (
    'controller_action' => 'Modules\\PendaftaranCoManagement\\Http\\Controllers\\CoManagementController@index',
    'permission' => 'pendaftaran-co-management.co-management.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2806 => 
  array (
    'controller_action' => 'Modules\\PendaftaranCoManagement\\Http\\Controllers\\CoManagementController@show',
    'permission' => 'pendaftaran-co-management.co-management.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2807 => 
  array (
    'controller_action' => 'Modules\\PendaftaranCoManagement\\Http\\Controllers\\CoManagementController@store',
    'permission' => 'pendaftaran-co-management.co-management.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2808 => 
  array (
    'controller_action' => 'Modules\\PendaftaranConsultation\\Http\\Controllers\\ConsultationController@index',
    'permission' => 'pendaftaran-consultation.consultation.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2809 => 
  array (
    'controller_action' => 'Modules\\PendaftaranConsultation\\Http\\Controllers\\ConsultationController@show',
    'permission' => 'pendaftaran-consultation.consultation.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2810 => 
  array (
    'controller_action' => 'Modules\\PendaftaranConsultation\\Http\\Controllers\\ConsultationController@store',
    'permission' => 'pendaftaran-consultation.consultation.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2811 => 
  array (
    'controller_action' => 'Modules\\PendaftaranConsultation\\Http\\Controllers\\ConsultationController@answer',
    'permission' => 'pendaftaran-consultation.consultation.answer',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2812 => 
  array (
    'controller_action' => 'Modules\\PendaftaranConsultation\\Http\\Controllers\\ConsultationController@cancel',
    'permission' => 'pendaftaran-consultation.consultation.cancel',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2813 => 
  array (
    'controller_action' => 'Modules\\PendaftaranConsultationAnswer\\Http\\Controllers\\ConsultationAnswerController@index',
    'permission' => 'pendaftaran-consultation-answer.consultation-answer.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2814 => 
  array (
    'controller_action' => 'Modules\\PendaftaranConsultationAnswer\\Http\\Controllers\\ConsultationAnswerController@show',
    'permission' => 'pendaftaran-consultation-answer.consultation-answer.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2815 => 
  array (
    'controller_action' => 'Modules\\PendaftaranConsultationAnswer\\Http\\Controllers\\ConsultationAnswerController@store',
    'permission' => 'pendaftaran-consultation-answer.consultation-answer.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2816 => 
  array (
    'controller_action' => 'Modules\\PendaftaranFunction\\Http\\Controllers\\PendaftaranFunctionController@index',
    'permission' => 'pendaftaran-function.pendaftaran-function.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2817 => 
  array (
    'controller_action' => 'Modules\\PendaftaranFunction\\Http\\Controllers\\PendaftaranFunctionController@show',
    'permission' => 'pendaftaran-function.pendaftaran-function.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2818 => 
  array (
    'controller_action' => 'Modules\\PendaftaranFunction\\Http\\Controllers\\PendaftaranFunctionController@store',
    'permission' => 'pendaftaran-function.pendaftaran-function.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2819 => 
  array (
    'controller_action' => 'Modules\\PendaftaranFunction\\Http\\Controllers\\PendaftaranFunctionController@update',
    'permission' => 'pendaftaran-function.pendaftaran-function.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2820 => 
  array (
    'controller_action' => 'Modules\\PendaftaranFunction\\Http\\Controllers\\PendaftaranFunctionController@destroy',
    'permission' => 'pendaftaran-function.pendaftaran-function.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2821 => 
  array (
    'controller_action' => 'Modules\\PendaftaranGuarantor\\Http\\Controllers\\GuarantorController@index',
    'permission' => 'pendaftaran-guarantor.guarantor.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2822 => 
  array (
    'controller_action' => 'Modules\\PendaftaranGuarantor\\Http\\Controllers\\GuarantorController@show',
    'permission' => 'pendaftaran-guarantor.guarantor.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2823 => 
  array (
    'controller_action' => 'Modules\\PendaftaranGuarantor\\Http\\Controllers\\GuarantorController@store',
    'permission' => 'pendaftaran-guarantor.guarantor.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2824 => 
  array (
    'controller_action' => 'Modules\\PendaftaranGuarantor\\Http\\Controllers\\GuarantorController@update',
    'permission' => 'pendaftaran-guarantor.guarantor.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2825 => 
  array (
    'controller_action' => 'Modules\\PendaftaranGuarantor\\Http\\Controllers\\GuarantorController@destroy',
    'permission' => 'pendaftaran-guarantor.guarantor.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2826 => 
  array (
    'controller_action' => 'Modules\\PendaftaranHistory\\Http\\Controllers\\PendaftaranHistoryController@index',
    'permission' => 'pendaftaran-history.pendaftaran-history.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2827 => 
  array (
    'controller_action' => 'Modules\\PendaftaranHistory\\Http\\Controllers\\PendaftaranHistoryController@show',
    'permission' => 'pendaftaran-history.pendaftaran-history.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2828 => 
  array (
    'controller_action' => 'Modules\\PendaftaranHistory\\Http\\Controllers\\PendaftaranHistoryController@store',
    'permission' => 'pendaftaran-history.pendaftaran-history.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2829 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientEscort\\Http\\Controllers\\PatientEscortController@index',
    'permission' => 'pendaftaran-patient-escort.patient-escort.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2830 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientEscort\\Http\\Controllers\\PatientEscortController@show',
    'permission' => 'pendaftaran-patient-escort.patient-escort.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2831 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientEscort\\Http\\Controllers\\PatientEscortController@store',
    'permission' => 'pendaftaran-patient-escort.patient-escort.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2832 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientEscort\\Http\\Controllers\\PatientEscortController@update',
    'permission' => 'pendaftaran-patient-escort.patient-escort.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2833 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientEscort\\Http\\Controllers\\PatientEscortController@destroy',
    'permission' => 'pendaftaran-patient-escort.patient-escort.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2834 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientEscortContact\\Http\\Controllers\\PatientEscortContactController@index',
    'permission' => 'pendaftaran-patient-escort-contact.patient-escort-contact.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2835 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientEscortContact\\Http\\Controllers\\PatientEscortContactController@show',
    'permission' => 'pendaftaran-patient-escort-contact.patient-escort-contact.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2836 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientEscortContact\\Http\\Controllers\\PatientEscortContactController@store',
    'permission' => 'pendaftaran-patient-escort-contact.patient-escort-contact.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2837 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientEscortContact\\Http\\Controllers\\PatientEscortContactController@update',
    'permission' => 'pendaftaran-patient-escort-contact.patient-escort-contact.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2838 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientEscortContact\\Http\\Controllers\\PatientEscortContactController@destroy',
    'permission' => 'pendaftaran-patient-escort-contact.patient-escort-contact.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2839 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientEscortIdentityCard\\Http\\Controllers\\PatientEscortIdentityCardController@index',
    'permission' => 'pendaftaran-patient-escort-identity-card.patient-escort-identity-card.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2840 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientEscortIdentityCard\\Http\\Controllers\\PatientEscortIdentityCardController@show',
    'permission' => 'pendaftaran-patient-escort-identity-card.patient-escort-identity-card.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2841 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientEscortIdentityCard\\Http\\Controllers\\PatientEscortIdentityCardController@store',
    'permission' => 'pendaftaran-patient-escort-identity-card.patient-escort-identity-card.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2842 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientEscortIdentityCard\\Http\\Controllers\\PatientEscortIdentityCardController@update',
    'permission' => 'pendaftaran-patient-escort-identity-card.patient-escort-identity-card.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2843 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientEscortIdentityCard\\Http\\Controllers\\PatientEscortIdentityCardController@destroy',
    'permission' => 'pendaftaran-patient-escort-identity-card.patient-escort-identity-card.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2844 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientGuardian\\Http\\Controllers\\PatientGuardianController@index',
    'permission' => 'pendaftaran-patient-guardian.patient-guardian.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2845 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientGuardian\\Http\\Controllers\\PatientGuardianController@show',
    'permission' => 'pendaftaran-patient-guardian.patient-guardian.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2846 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientGuardian\\Http\\Controllers\\PatientGuardianController@store',
    'permission' => 'pendaftaran-patient-guardian.patient-guardian.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2847 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientGuardian\\Http\\Controllers\\PatientGuardianController@update',
    'permission' => 'pendaftaran-patient-guardian.patient-guardian.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2848 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientGuardian\\Http\\Controllers\\PatientGuardianController@destroy',
    'permission' => 'pendaftaran-patient-guardian.patient-guardian.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2849 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientGuardianContact\\Http\\Controllers\\PatientGuardianContactController@index',
    'permission' => 'pendaftaran-patient-guardian-contact.patient-guardian-contact.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2850 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientGuardianContact\\Http\\Controllers\\PatientGuardianContactController@show',
    'permission' => 'pendaftaran-patient-guardian-contact.patient-guardian-contact.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2851 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientGuardianContact\\Http\\Controllers\\PatientGuardianContactController@store',
    'permission' => 'pendaftaran-patient-guardian-contact.patient-guardian-contact.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2852 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientGuardianContact\\Http\\Controllers\\PatientGuardianContactController@update',
    'permission' => 'pendaftaran-patient-guardian-contact.patient-guardian-contact.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2853 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientGuardianContact\\Http\\Controllers\\PatientGuardianContactController@destroy',
    'permission' => 'pendaftaran-patient-guardian-contact.patient-guardian-contact.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2854 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientGuardianIdentityCard\\Http\\Controllers\\PatientGuardianIdentityCardController@index',
    'permission' => 'pendaftaran-patient-guardian-identity-card.patient-guardian-identity-card.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2855 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientGuardianIdentityCard\\Http\\Controllers\\PatientGuardianIdentityCardController@show',
    'permission' => 'pendaftaran-patient-guardian-identity-card.patient-guardian-identity-card.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2856 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientGuardianIdentityCard\\Http\\Controllers\\PatientGuardianIdentityCardController@store',
    'permission' => 'pendaftaran-patient-guardian-identity-card.patient-guardian-identity-card.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2857 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientGuardianIdentityCard\\Http\\Controllers\\PatientGuardianIdentityCardController@update',
    'permission' => 'pendaftaran-patient-guardian-identity-card.patient-guardian-identity-card.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2858 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientGuardianIdentityCard\\Http\\Controllers\\PatientGuardianIdentityCardController@destroy',
    'permission' => 'pendaftaran-patient-guardian-identity-card.patient-guardian-identity-card.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2859 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientPurpose\\Http\\Controllers\\PatientPurposeController@index',
    'permission' => 'pendaftaran-patient-purpose.patient-purpose.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2860 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientPurpose\\Http\\Controllers\\PatientPurposeController@show',
    'permission' => 'pendaftaran-patient-purpose.patient-purpose.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2861 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientPurpose\\Http\\Controllers\\PatientPurposeController@store',
    'permission' => 'pendaftaran-patient-purpose.patient-purpose.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2862 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientPurpose\\Http\\Controllers\\PatientPurposeController@update',
    'permission' => 'pendaftaran-patient-purpose.patient-purpose.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2863 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientPurpose\\Http\\Controllers\\PatientPurposeController@destroy',
    'permission' => 'pendaftaran-patient-purpose.patient-purpose.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2864 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientTransfer\\Http\\Controllers\\PatientTransferController@index',
    'permission' => 'pendaftaran-patient-transfer.patient-transfer.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2865 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientTransfer\\Http\\Controllers\\PatientTransferController@show',
    'permission' => 'pendaftaran-patient-transfer.patient-transfer.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2866 => 
  array (
    'controller_action' => 'Modules\\PendaftaranPatientTransfer\\Http\\Controllers\\PatientTransferController@store',
    'permission' => 'pendaftaran-patient-transfer.patient-transfer.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2867 => 
  array (
    'controller_action' => 'Modules\\PendaftaranQueueCall\\Http\\Controllers\\QueueCallController@index',
    'permission' => 'pendaftaran-queue-call.queue-call.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2868 => 
  array (
    'controller_action' => 'Modules\\PendaftaranQueueCall\\Http\\Controllers\\QueueCallController@show',
    'permission' => 'pendaftaran-queue-call.queue-call.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2869 => 
  array (
    'controller_action' => 'Modules\\PendaftaranQueueCall\\Http\\Controllers\\QueueCallController@store',
    'permission' => 'pendaftaran-queue-call.queue-call.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2870 => 
  array (
    'controller_action' => 'Modules\\PendaftaranReferral\\Http\\Controllers\\ReferralController@index',
    'permission' => 'pendaftaran-referral.referral.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2871 => 
  array (
    'controller_action' => 'Modules\\PendaftaranReferral\\Http\\Controllers\\ReferralController@show',
    'permission' => 'pendaftaran-referral.referral.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2872 => 
  array (
    'controller_action' => 'Modules\\PendaftaranReferral\\Http\\Controllers\\ReferralController@store',
    'permission' => 'pendaftaran-referral.referral.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2873 => 
  array (
    'controller_action' => 'Modules\\PendaftaranReferral\\Http\\Controllers\\ReferralController@update',
    'permission' => 'pendaftaran-referral.referral.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2874 => 
  array (
    'controller_action' => 'Modules\\PendaftaranReferralLetter\\Http\\Controllers\\ReferralLetterController@index',
    'permission' => 'pendaftaran-referral-letter.referral-letter.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2875 => 
  array (
    'controller_action' => 'Modules\\PendaftaranReferralLetter\\Http\\Controllers\\ReferralLetterController@show',
    'permission' => 'pendaftaran-referral-letter.referral-letter.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2876 => 
  array (
    'controller_action' => 'Modules\\PendaftaranReferralLetter\\Http\\Controllers\\ReferralLetterController@store',
    'permission' => 'pendaftaran-referral-letter.referral-letter.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2877 => 
  array (
    'controller_action' => 'Modules\\PendaftaranRegistration\\Http\\Controllers\\RegistrationController@index',
    'permission' => 'pendaftaran-registration.registration.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2878 => 
  array (
    'controller_action' => 'Modules\\PendaftaranRegistration\\Http\\Controllers\\RegistrationController@show',
    'permission' => 'pendaftaran-registration.registration.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2879 => 
  array (
    'controller_action' => 'Modules\\PendaftaranRegistration\\Http\\Controllers\\RegistrationController@store',
    'permission' => 'pendaftaran-registration.registration.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2880 => 
  array (
    'controller_action' => 'Modules\\PendaftaranRegistration\\Http\\Controllers\\RegistrationController@update',
    'permission' => 'pendaftaran-registration.registration.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2881 => 
  array (
    'controller_action' => 'Modules\\PendaftaranRegistration\\Http\\Controllers\\RegistrationController@destroy',
    'permission' => 'pendaftaran-registration.registration.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2882 => 
  array (
    'controller_action' => 'Modules\\PendaftaranReservation\\Http\\Controllers\\ReservationController@index',
    'permission' => 'pendaftaran-reservation.reservation.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2883 => 
  array (
    'controller_action' => 'Modules\\PendaftaranReservation\\Http\\Controllers\\ReservationController@show',
    'permission' => 'pendaftaran-reservation.reservation.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2884 => 
  array (
    'controller_action' => 'Modules\\PendaftaranReservation\\Http\\Controllers\\ReservationController@store',
    'permission' => 'pendaftaran-reservation.reservation.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2885 => 
  array (
    'controller_action' => 'Modules\\PendaftaranReservation\\Http\\Controllers\\ReservationController@update',
    'permission' => 'pendaftaran-reservation.reservation.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2886 => 
  array (
    'controller_action' => 'Modules\\PendaftaranReservation\\Http\\Controllers\\ReservationController@destroy',
    'permission' => 'pendaftaran-reservation.reservation.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2887 => 
  array (
    'controller_action' => 'Modules\\PendaftaranSelfCheckin\\Http\\Controllers\\SelfCheckinQueueController@index',
    'permission' => 'pendaftaran-self-checkin.self-checkin-queue.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2888 => 
  array (
    'controller_action' => 'Modules\\PendaftaranSelfCheckin\\Http\\Controllers\\SelfCheckinQueueController@store',
    'permission' => 'pendaftaran-self-checkin.self-checkin-queue.store',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2889 => 
  array (
    'controller_action' => 'Modules\\PendaftaranSelfCheckin\\Http\\Controllers\\SelfCheckinQueueController@call',
    'permission' => 'pendaftaran-self-checkin.self-checkin-queue.call',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2890 => 
  array (
    'controller_action' => 'Modules\\PendaftaranSelfCheckin\\Http\\Controllers\\SelfCheckinQueueController@complete',
    'permission' => 'pendaftaran-self-checkin.self-checkin-queue.complete',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2891 => 
  array (
    'controller_action' => 'Modules\\PendaftaranServiceHandover\\Http\\Controllers\\ServiceHandoverController@index',
    'permission' => 'pendaftaran-service-handover.service-handover.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2892 => 
  array (
    'controller_action' => 'Modules\\PendaftaranServiceHandover\\Http\\Controllers\\ServiceHandoverController@show',
    'permission' => 'pendaftaran-service-handover.service-handover.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2893 => 
  array (
    'controller_action' => 'Modules\\PendaftaranServiceHandover\\Http\\Controllers\\ServiceHandoverController@store',
    'permission' => 'pendaftaran-service-handover.service-handover.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2894 => 
  array (
    'controller_action' => 'Modules\\PendaftaranServiceHandover\\Http\\Controllers\\ServiceHandoverController@update',
    'permission' => 'pendaftaran-service-handover.service-handover.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2895 => 
  array (
    'controller_action' => 'Modules\\PendaftaranVisit\\Http\\Controllers\\VisitController@index',
    'permission' => 'pendaftaran-visit.visit.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2896 => 
  array (
    'controller_action' => 'Modules\\PendaftaranVisit\\Http\\Controllers\\VisitController@store',
    'permission' => 'pendaftaran-visit.visit.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2897 => 
  array (
    'controller_action' => 'Modules\\PendaftaranVisit\\Http\\Controllers\\VisitController@show',
    'permission' => 'pendaftaran-visit.visit.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2898 => 
  array (
    'controller_action' => 'Modules\\PendaftaranVisit\\Http\\Controllers\\VisitController@update',
    'permission' => 'pendaftaran-visit.visit.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2899 => 
  array (
    'controller_action' => 'Modules\\PendaftaranVisit\\Http\\Controllers\\VisitController@destroy',
    'permission' => 'pendaftaran-visit.visit.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2900 => 
  array (
    'controller_action' => 'Modules\\PendaftaranVisit\\Http\\Controllers\\VisitController@transfer',
    'permission' => 'pendaftaran-visit.visit.transfer',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2901 => 
  array (
    'controller_action' => 'Modules\\PendaftaranVisit\\Http\\Controllers\\VisitController@discharge',
    'permission' => 'pendaftaran-visit.visit.discharge',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2902 => 
  array (
    'controller_action' => 'Modules\\PendaftaranVisit\\Http\\Controllers\\VisitController@finalizeService',
    'permission' => 'pendaftaran-visit.visit.finalize-service',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2903 => 
  array (
    'controller_action' => 'Modules\\PendaftaranVisitCancellation\\Http\\Controllers\\VisitCancellationController@index',
    'permission' => 'pendaftaran-visit-cancellation.visit-cancellation.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2904 => 
  array (
    'controller_action' => 'Modules\\PendaftaranVisitCancellation\\Http\\Controllers\\VisitCancellationController@show',
    'permission' => 'pendaftaran-visit-cancellation.visit-cancellation.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2905 => 
  array (
    'controller_action' => 'Modules\\PendaftaranVisitCancellation\\Http\\Controllers\\VisitCancellationController@store',
    'permission' => 'pendaftaran-visit-cancellation.visit-cancellation.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2906 => 
  array (
    'controller_action' => 'Modules\\PendaftaranVisitDateChange\\Http\\Controllers\\VisitDateChangeController@index',
    'permission' => 'pendaftaran-visit-date-change.visit-date-change.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2907 => 
  array (
    'controller_action' => 'Modules\\PendaftaranVisitDateChange\\Http\\Controllers\\VisitDateChangeController@show',
    'permission' => 'pendaftaran-visit-date-change.visit-date-change.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2908 => 
  array (
    'controller_action' => 'Modules\\PendaftaranVisitDateChange\\Http\\Controllers\\VisitDateChangeController@store',
    'permission' => 'pendaftaran-visit-date-change.visit-date-change.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2909 => 
  array (
    'controller_action' => 'Modules\\PendaftaranVisitDestination\\Http\\Controllers\\PendaftaranVisitDestinationController@index',
    'permission' => 'pendaftaran-visit-destination.pendaftaran-visit-destination.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2910 => 
  array (
    'controller_action' => 'Modules\\PendaftaranVisitDestination\\Http\\Controllers\\PendaftaranVisitDestinationController@store',
    'permission' => 'pendaftaran-visit-destination.pendaftaran-visit-destination.store',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2911 => 
  array (
    'controller_action' => 'Modules\\PendaftaranVisitDestination\\Http\\Controllers\\PendaftaranVisitDestinationController@show',
    'permission' => 'pendaftaran-visit-destination.pendaftaran-visit-destination.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2912 => 
  array (
    'controller_action' => 'Modules\\PendaftaranVisitDestination\\Http\\Controllers\\PendaftaranVisitDestinationController@update',
    'permission' => 'pendaftaran-visit-destination.pendaftaran-visit-destination.update',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2913 => 
  array (
    'controller_action' => 'Modules\\PendaftaranVisitDestination\\Http\\Controllers\\PendaftaranVisitDestinationController@destroy',
    'permission' => 'pendaftaran-visit-destination.pendaftaran-visit-destination.destroy',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2914 => 
  array (
    'controller_action' => 'Modules\\PendaftaranWardQueue\\Http\\Controllers\\WardQueueController@index',
    'permission' => 'pendaftaran-ward-queue.ward-queue.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2915 => 
  array (
    'controller_action' => 'Modules\\PendaftaranWardQueue\\Http\\Controllers\\WardQueueController@show',
    'permission' => 'pendaftaran-ward-queue.ward-queue.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2916 => 
  array (
    'controller_action' => 'Modules\\PendaftaranWardQueue\\Http\\Controllers\\WardQueueController@store',
    'permission' => 'pendaftaran-ward-queue.ward-queue.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2917 => 
  array (
    'controller_action' => 'Modules\\PendaftaranWardQueue\\Http\\Controllers\\WardQueueController@update',
    'permission' => 'pendaftaran-ward-queue.ward-queue.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2918 => 
  array (
    'controller_action' => 'Modules\\PenjaminRSAttendingPhysician\\Http\\Controllers\\PenjaminRSAttendingPhysicianController@index',
    'permission' => 'penjamin-r-s-attending-physician.penjamin-r-s-attending-physician.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2919 => 
  array (
    'controller_action' => 'Modules\\PenjaminRSAttendingPhysician\\Http\\Controllers\\PenjaminRSAttendingPhysicianController@show',
    'permission' => 'penjamin-r-s-attending-physician.penjamin-r-s-attending-physician.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2920 => 
  array (
    'controller_action' => 'Modules\\PenjaminRSAttendingPhysician\\Http\\Controllers\\PenjaminRSAttendingPhysicianController@store',
    'permission' => 'penjamin-r-s-attending-physician.penjamin-r-s-attending-physician.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2921 => 
  array (
    'controller_action' => 'Modules\\PenjaminRSAttendingPhysician\\Http\\Controllers\\PenjaminRSAttendingPhysicianController@update',
    'permission' => 'penjamin-r-s-attending-physician.penjamin-r-s-attending-physician.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2922 => 
  array (
    'controller_action' => 'Modules\\PenjaminRSAttendingPhysician\\Http\\Controllers\\PenjaminRSAttendingPhysicianController@destroy',
    'permission' => 'penjamin-r-s-attending-physician.penjamin-r-s-attending-physician.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2923 => 
  array (
    'controller_action' => 'Modules\\PenjaminRSClaimDriver\\Http\\Controllers\\PenjaminRSClaimDriverController@index',
    'permission' => 'penjamin-r-s-claim-driver.penjamin-r-s-claim-driver.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2924 => 
  array (
    'controller_action' => 'Modules\\PenjaminRSClaimDriver\\Http\\Controllers\\PenjaminRSClaimDriverController@show',
    'permission' => 'penjamin-r-s-claim-driver.penjamin-r-s-claim-driver.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2925 => 
  array (
    'controller_action' => 'Modules\\PenjaminRSClaimDriver\\Http\\Controllers\\PenjaminRSClaimDriverController@store',
    'permission' => 'penjamin-r-s-claim-driver.penjamin-r-s-claim-driver.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2926 => 
  array (
    'controller_action' => 'Modules\\PenjaminRSClaimDriver\\Http\\Controllers\\PenjaminRSClaimDriverController@update',
    'permission' => 'penjamin-r-s-claim-driver.penjamin-r-s-claim-driver.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2927 => 
  array (
    'controller_action' => 'Modules\\PenjaminRSClaimDriver\\Http\\Controllers\\PenjaminRSClaimDriverController@destroy',
    'permission' => 'penjamin-r-s-claim-driver.penjamin-r-s-claim-driver.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2928 => 
  array (
    'controller_action' => 'Modules\\PenjaminRSDischargeMethod\\Http\\Controllers\\DischargeMethodController@index',
    'permission' => 'penjamin-r-s-discharge-method.discharge-method.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2929 => 
  array (
    'controller_action' => 'Modules\\PenjaminRSDischargeMethod\\Http\\Controllers\\DischargeMethodController@show',
    'permission' => 'penjamin-r-s-discharge-method.discharge-method.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2930 => 
  array (
    'controller_action' => 'Modules\\PenjaminRSDischargeMethod\\Http\\Controllers\\DischargeMethodController@store',
    'permission' => 'penjamin-r-s-discharge-method.discharge-method.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2931 => 
  array (
    'controller_action' => 'Modules\\PenjaminRSDischargeMethod\\Http\\Controllers\\DischargeMethodController@update',
    'permission' => 'penjamin-r-s-discharge-method.discharge-method.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2932 => 
  array (
    'controller_action' => 'Modules\\PenjaminRSDischargeMethod\\Http\\Controllers\\DischargeMethodController@destroy',
    'permission' => 'penjamin-r-s-discharge-method.discharge-method.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2933 => 
  array (
    'controller_action' => 'Modules\\PenjualanSale\\Http\\Controllers\\SaleController@index',
    'permission' => 'penjualan-sale.sale.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2934 => 
  array (
    'controller_action' => 'Modules\\PenjualanSale\\Http\\Controllers\\SaleController@show',
    'permission' => 'penjualan-sale.sale.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2935 => 
  array (
    'controller_action' => 'Modules\\PenjualanSale\\Http\\Controllers\\SaleController@store',
    'permission' => 'penjualan-sale.sale.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2936 => 
  array (
    'controller_action' => 'Modules\\PenjualanSale\\Http\\Controllers\\SaleController@update',
    'permission' => 'penjualan-sale.sale.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2937 => 
  array (
    'controller_action' => 'Modules\\PenjualanSaleItem\\Http\\Controllers\\SaleItemController@index',
    'permission' => 'penjualan-sale-item.sale-item.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2938 => 
  array (
    'controller_action' => 'Modules\\PenjualanSaleItem\\Http\\Controllers\\SaleItemController@show',
    'permission' => 'penjualan-sale-item.sale-item.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2939 => 
  array (
    'controller_action' => 'Modules\\PenjualanSaleItem\\Http\\Controllers\\SaleItemController@store',
    'permission' => 'penjualan-sale-item.sale-item.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2940 => 
  array (
    'controller_action' => 'Modules\\PenjualanSaleReturn\\Http\\Controllers\\SaleReturnController@index',
    'permission' => 'penjualan-sale-return.sale-return.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2941 => 
  array (
    'controller_action' => 'Modules\\PenjualanSaleReturn\\Http\\Controllers\\SaleReturnController@show',
    'permission' => 'penjualan-sale-return.sale-return.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2942 => 
  array (
    'controller_action' => 'Modules\\PenjualanSaleReturn\\Http\\Controllers\\SaleReturnController@store',
    'permission' => 'penjualan-sale-return.sale-return.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2943 => 
  array (
    'controller_action' => 'Modules\\RsOnline\\Http\\Controllers\\RsOnlineController@index',
    'permission' => 'rs-online.rs-online.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2944 => 
  array (
    'controller_action' => 'Modules\\RsOnline\\Http\\Controllers\\RsOnlineController@show',
    'permission' => 'rs-online.rs-online.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2945 => 
  array (
    'controller_action' => 'Modules\\RsOnline\\Http\\Controllers\\RsOnlineController@pushSdm',
    'permission' => 'rs-online.rs-online.push-sdm',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2946 => 
  array (
    'controller_action' => 'Modules\\RsOnline\\Http\\Controllers\\RsOnlineController@pushLayanan',
    'permission' => 'rs-online.rs-online.push-layanan',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2947 => 
  array (
    'controller_action' => 'Modules\\RsOnline\\Http\\Controllers\\RsOnlineController@pushAlkes',
    'permission' => 'rs-online.rs-online.push-alkes',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2948 => 
  array (
    'controller_action' => 'Modules\\RsOnline\\Http\\Controllers\\RsOnlineController@pushTempatTidur',
    'permission' => 'rs-online.rs-online.push-tempat-tidur',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2949 => 
  array (
    'controller_action' => 'Modules\\RsOnline\\Http\\Controllers\\RsOnlineController@storeRegistrasiUser',
    'permission' => 'rs-online.rs-online.store-registrasi-user',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2950 => 
  array (
    'controller_action' => 'Modules\\RsOnline\\Http\\Controllers\\RsOnlineController@updateRegistrasiUser',
    'permission' => 'rs-online.rs-online.update-registrasi-user',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2951 => 
  array (
    'controller_action' => 'Modules\\RsOnline\\Http\\Controllers\\RsOnlineController@destroyRegistrasiUser',
    'permission' => 'rs-online.rs-online.destroy-registrasi-user',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2952 => 
  array (
    'controller_action' => 'Modules\\RsOnline\\Http\\Controllers\\ReferensiController@sdm',
    'permission' => 'rs-online.referensi.sdm',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2953 => 
  array (
    'controller_action' => 'Modules\\RsOnline\\Http\\Controllers\\ReferensiController@sarana',
    'permission' => 'rs-online.referensi.sarana',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2954 => 
  array (
    'controller_action' => 'Modules\\RsOnline\\Http\\Controllers\\ReferensiController@ruangPerawatan',
    'permission' => 'rs-online.referensi.ruang-perawatan',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2955 => 
  array (
    'controller_action' => 'Modules\\RsOnline\\Http\\Controllers\\ReferensiController@pelayanan',
    'permission' => 'rs-online.referensi.pelayanan',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2956 => 
  array (
    'controller_action' => 'Modules\\RsOnline\\Http\\Controllers\\ReferensiController@kelas',
    'permission' => 'rs-online.referensi.kelas',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2957 => 
  array (
    'controller_action' => 'Modules\\RsOnline\\Http\\Controllers\\ReferensiController@kategoriSdm',
    'permission' => 'rs-online.referensi.kategori-sdm',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2958 => 
  array (
    'controller_action' => 'Modules\\RsOnline\\Http\\Controllers\\ReferensiController@kategoriLayanan',
    'permission' => 'rs-online.referensi.kategori-layanan',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2959 => 
  array (
    'controller_action' => 'Modules\\RsOnline\\Http\\Controllers\\ReferensiController@instalasi',
    'permission' => 'rs-online.referensi.instalasi',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2960 => 
  array (
    'controller_action' => 'Modules\\RsOnline\\Http\\Controllers\\ReferensiController@alkes',
    'permission' => 'rs-online.referensi.alkes',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2961 => 
  array (
    'controller_action' => 'Modules\\RsOnline\\Http\\Controllers\\ReferensiController@faskes',
    'permission' => 'rs-online.referensi.faskes',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2962 => 
  array (
    'controller_action' => 'Modules\\SatuSehatAnak\\Http\\Controllers\\BundleController@mtbs',
    'permission' => 'satu-sehat-anak.bundle.mtbs',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2963 => 
  array (
    'controller_action' => 'Modules\\SatuSehatAnak\\Http\\Controllers\\BundleController@imunisasi',
    'permission' => 'satu-sehat-anak.bundle.imunisasi',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2964 => 
  array (
    'controller_action' => 'Modules\\SatuSehatAnak\\Http\\Controllers\\BundleController@gizi',
    'permission' => 'satu-sehat-anak.bundle.gizi',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2965 => 
  array (
    'controller_action' => 'Modules\\SatuSehatAnak\\Http\\Controllers\\BundleController@tumbuhKembang',
    'permission' => 'satu-sehat-anak.bundle.tumbuh-kembang',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2966 => 
  array (
    'controller_action' => 'Modules\\SatuSehatAnak\\Http\\Controllers\\BundleController@pkpr',
    'permission' => 'satu-sehat-anak.bundle.pkpr',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2967 => 
  array (
    'controller_action' => 'Modules\\SatuSehatAnak\\Http\\Controllers\\BundleController@imunisasiCovid19',
    'permission' => 'satu-sehat-anak.bundle.imunisasi-covid19',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2968 => 
  array (
    'controller_action' => 'Modules\\SatuSehatFarmasi\\Http\\Controllers\\MedicationRequestController@store',
    'permission' => 'satu-sehat-farmasi.medication-request.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2969 => 
  array (
    'controller_action' => 'Modules\\SatuSehatIbuAnak\\Http\\Controllers\\BundleController@anc',
    'permission' => 'satu-sehat-ibu-anak.bundle.anc',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2970 => 
  array (
    'controller_action' => 'Modules\\SatuSehatIbuAnak\\Http\\Controllers\\BundleController@inc',
    'permission' => 'satu-sehat-ibu-anak.bundle.inc',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2971 => 
  array (
    'controller_action' => 'Modules\\SatuSehatIbuAnak\\Http\\Controllers\\BundleController@pnc',
    'permission' => 'satu-sehat-ibu-anak.bundle.pnc',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2972 => 
  array (
    'controller_action' => 'Modules\\SatuSehatIbuAnak\\Http\\Controllers\\BundleController@neonatus',
    'permission' => 'satu-sehat-ibu-anak.bundle.neonatus',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2973 => 
  array (
    'controller_action' => 'Modules\\SatuSehatIbuAnak\\Http\\Controllers\\BundleController@shk',
    'permission' => 'satu-sehat-ibu-anak.bundle.shk',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2974 => 
  array (
    'controller_action' => 'Modules\\SatuSehatIbuAnak\\Http\\Controllers\\BundleController@kematianMaternal',
    'permission' => 'satu-sehat-ibu-anak.bundle.kematian-maternal',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2975 => 
  array (
    'controller_action' => 'Modules\\SatuSehatIbuAnak\\Http\\Controllers\\BundleController@dataKelahiran',
    'permission' => 'satu-sehat-ibu-anak.bundle.data-kelahiran',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2976 => 
  array (
    'controller_action' => 'Modules\\SatuSehatIgd\\Http\\Controllers\\EncounterController@store',
    'permission' => 'satu-sehat-igd.encounter.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2977 => 
  array (
    'controller_action' => 'Modules\\SatuSehatIgd\\Http\\Controllers\\TriageObservationController@store',
    'permission' => 'satu-sehat-igd.triage-observation.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2978 => 
  array (
    'controller_action' => 'Modules\\SatuSehatKlaim\\Http\\Controllers\\SatuSehatKlaimController@index',
    'permission' => 'satu-sehat-klaim.satu-sehat-klaim.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2979 => 
  array (
    'controller_action' => 'Modules\\SatuSehatKlaim\\Http\\Controllers\\SatuSehatKlaimController@show',
    'permission' => 'satu-sehat-klaim.satu-sehat-klaim.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2980 => 
  array (
    'controller_action' => 'Modules\\SatuSehatKlaim\\Http\\Controllers\\SatuSehatKlaimController@store',
    'permission' => 'satu-sehat-klaim.satu-sehat-klaim.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2981 => 
  array (
    'controller_action' => 'Modules\\SatuSehatKptl\\Http\\Controllers\\KptlController@code',
    'permission' => 'satu-sehat-kptl.kptl.code',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2982 => 
  array (
    'controller_action' => 'Modules\\SatuSehatKptl\\Http\\Controllers\\KptlController@baseCode',
    'permission' => 'satu-sehat-kptl.kptl.base-code',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2983 => 
  array (
    'controller_action' => 'Modules\\SatuSehatKptl\\Http\\Controllers\\KptlController@baseCodeCombination',
    'permission' => 'satu-sehat-kptl.kptl.base-code-combination',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2984 => 
  array (
    'controller_action' => 'Modules\\SatuSehatKptl\\Http\\Controllers\\KptlController@modifier',
    'permission' => 'satu-sehat-kptl.kptl.modifier',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2985 => 
  array (
    'controller_action' => 'Modules\\SatuSehatKptl\\Http\\Controllers\\KptlController@modifierValue',
    'permission' => 'satu-sehat-kptl.kptl.modifier-value',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2986 => 
  array (
    'controller_action' => 'Modules\\SatuSehatKptl\\Http\\Controllers\\KptlController@baseCodeByModifier',
    'permission' => 'satu-sehat-kptl.kptl.base-code-by-modifier',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2987 => 
  array (
    'controller_action' => 'Modules\\SatuSehatMasterData\\Http\\Controllers\\MasterDataController@provinces',
    'permission' => 'satu-sehat-master-data.master-data.provinces',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2988 => 
  array (
    'controller_action' => 'Modules\\SatuSehatMasterData\\Http\\Controllers\\MasterDataController@cities',
    'permission' => 'satu-sehat-master-data.master-data.cities',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2989 => 
  array (
    'controller_action' => 'Modules\\SatuSehatMasterData\\Http\\Controllers\\MasterDataController@districts',
    'permission' => 'satu-sehat-master-data.master-data.districts',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2990 => 
  array (
    'controller_action' => 'Modules\\SatuSehatMasterData\\Http\\Controllers\\MasterDataController@subDistricts',
    'permission' => 'satu-sehat-master-data.master-data.sub-districts',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2991 => 
  array (
    'controller_action' => 'Modules\\SatuSehatMasterData\\Http\\Controllers\\MasterDataController@sarana',
    'permission' => 'satu-sehat-master-data.master-data.sarana',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2992 => 
  array (
    'controller_action' => 'Modules\\SatuSehatMasterData\\Http\\Controllers\\MasterDataController@kfaProduct',
    'permission' => 'satu-sehat-master-data.master-data.kfa-product',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2993 => 
  array (
    'controller_action' => 'Modules\\SatuSehatMasterData\\Http\\Controllers\\MasterDataController@kfaProductsAll',
    'permission' => 'satu-sehat-master-data.master-data.kfa-products-all',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  2994 => 
  array (
    'controller_action' => 'Modules\\SatuSehatPenyakitMenular\\Http\\Controllers\\SatuSehatPenyakitMenularController@index',
    'permission' => 'satu-sehat-penyakit-menular.satu-sehat-penyakit-menular.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2995 => 
  array (
    'controller_action' => 'Modules\\SatuSehatPenyakitMenular\\Http\\Controllers\\SatuSehatPenyakitMenularController@show',
    'permission' => 'satu-sehat-penyakit-menular.satu-sehat-penyakit-menular.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2996 => 
  array (
    'controller_action' => 'Modules\\SatuSehatPenyakitMenular\\Http\\Controllers\\SatuSehatPenyakitMenularController@store',
    'permission' => 'satu-sehat-penyakit-menular.satu-sehat-penyakit-menular.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2997 => 
  array (
    'controller_action' => 'Modules\\SatuSehatPtmRegistry\\Http\\Controllers\\BundleController@skriningPtm',
    'permission' => 'satu-sehat-ptm-registry.bundle.skrining-ptm',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2998 => 
  array (
    'controller_action' => 'Modules\\SatuSehatPtmRegistry\\Http\\Controllers\\BundleController@kanker',
    'permission' => 'satu-sehat-ptm-registry.bundle.kanker',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  2999 => 
  array (
    'controller_action' => 'Modules\\SatuSehatPtmRegistry\\Http\\Controllers\\BundleController@jantung',
    'permission' => 'satu-sehat-ptm-registry.bundle.jantung',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3000 => 
  array (
    'controller_action' => 'Modules\\SatuSehatPtmRegistry\\Http\\Controllers\\BundleController@stroke',
    'permission' => 'satu-sehat-ptm-registry.bundle.stroke',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3001 => 
  array (
    'controller_action' => 'Modules\\SatuSehatPtmRegistry\\Http\\Controllers\\BundleController@uronefrologi',
    'permission' => 'satu-sehat-ptm-registry.bundle.uronefrologi',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3002 => 
  array (
    'controller_action' => 'Modules\\SatuSehatRawatInap\\Http\\Controllers\\EncounterController@store',
    'permission' => 'satu-sehat-rawat-inap.encounter.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3003 => 
  array (
    'controller_action' => 'Modules\\SatuSehatRawatJalan\\Http\\Controllers\\EncounterController@store',
    'permission' => 'satu-sehat-rawat-jalan.encounter.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3004 => 
  array (
    'controller_action' => 'Modules\\SatuSehatSpesialistik\\Http\\Controllers\\SatuSehatSpesialistikController@index',
    'permission' => 'satu-sehat-spesialistik.satu-sehat-spesialistik.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3005 => 
  array (
    'controller_action' => 'Modules\\SatuSehatSpesialistik\\Http\\Controllers\\SatuSehatSpesialistikController@show',
    'permission' => 'satu-sehat-spesialistik.satu-sehat-spesialistik.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3006 => 
  array (
    'controller_action' => 'Modules\\SatuSehatSpesialistik\\Http\\Controllers\\SatuSehatSpesialistikController@store',
    'permission' => 'satu-sehat-spesialistik.satu-sehat-spesialistik.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3007 => 
  array (
    'controller_action' => 'Modules\\SirsOnlineBor\\Http\\Controllers\\SirsOnlineBorController@index',
    'permission' => 'sirs-online-bor.sirs-online-bor.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3008 => 
  array (
    'controller_action' => 'Modules\\SirsOnlineBor\\Http\\Controllers\\SirsOnlineBorController@store',
    'permission' => 'sirs-online-bor.sirs-online-bor.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3009 => 
  array (
    'controller_action' => 'Modules\\SirsOnlineBor\\Http\\Controllers\\SirsOnlineBorController@show',
    'permission' => 'sirs-online-bor.sirs-online-bor.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3010 => 
  array (
    'controller_action' => 'Modules\\SirsOnlineBor\\Http\\Controllers\\SirsOnlineBorController@update',
    'permission' => 'sirs-online-bor.sirs-online-bor.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3011 => 
  array (
    'controller_action' => 'Modules\\SirsOnlineBor\\Http\\Controllers\\SirsOnlineBorController@destroy',
    'permission' => 'sirs-online-bor.sirs-online-bor.destroy',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3012 => 
  array (
    'controller_action' => 'Modules\\Sisrute\\Http\\Controllers\\RujukanController@index',
    'permission' => 'sisrute.rujukan.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3013 => 
  array (
    'controller_action' => 'Modules\\Sisrute\\Http\\Controllers\\RujukanController@show',
    'permission' => 'sisrute.rujukan.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3014 => 
  array (
    'controller_action' => 'Modules\\Sisrute\\Http\\Controllers\\RujukanController@kirim',
    'permission' => 'sisrute.rujukan.kirim',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3015 => 
  array (
    'controller_action' => 'Modules\\Sisrute\\Http\\Controllers\\RujukanController@notif',
    'permission' => 'sisrute.rujukan.notif',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3016 => 
  array (
    'controller_action' => 'Modules\\Sisrute\\Http\\Controllers\\RujukanController@jawab',
    'permission' => 'sisrute.rujukan.jawab',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3017 => 
  array (
    'controller_action' => 'Modules\\Sisrute\\Http\\Controllers\\RujukanController@batal',
    'permission' => 'sisrute.rujukan.batal',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3018 => 
  array (
    'controller_action' => 'Modules\\Sisrute\\Http\\Controllers\\RujukanController@images',
    'permission' => 'sisrute.rujukan.images',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3019 => 
  array (
    'controller_action' => 'Modules\\Sisrute\\Http\\Controllers\\RujukanController@pasien',
    'permission' => 'sisrute.rujukan.pasien',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3020 => 
  array (
    'controller_action' => 'Modules\\Sisrute\\Http\\Controllers\\ReferensiController@faskes',
    'permission' => 'sisrute.referensi.faskes',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3021 => 
  array (
    'controller_action' => 'Modules\\Sisrute\\Http\\Controllers\\ReferensiController@alasanRujukan',
    'permission' => 'sisrute.referensi.alasan-rujukan',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3022 => 
  array (
    'controller_action' => 'Modules\\Sisrute\\Http\\Controllers\\ReferensiController@diagnosa',
    'permission' => 'sisrute.referensi.diagnosa',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3023 => 
  array (
    'controller_action' => 'Modules\\Sisrute\\Http\\Controllers\\ReferensiController@jenisPelayanan',
    'permission' => 'sisrute.referensi.jenis-pelayanan',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3024 => 
  array (
    'controller_action' => 'Modules\\Sisrute\\Http\\Controllers\\ReferensiController@keadaanKeluar',
    'permission' => 'sisrute.referensi.keadaan-keluar',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3025 => 
  array (
    'controller_action' => 'Modules\\Sisrute\\Http\\Controllers\\ReferensiController@caraKeluar',
    'permission' => 'sisrute.referensi.cara-keluar',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3026 => 
  array (
    'controller_action' => 'Modules\\Sisrute\\Http\\Controllers\\ReferensiController@filterFaskesKriteria',
    'permission' => 'sisrute.referensi.filter-faskes-kriteria',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3027 => 
  array (
    'controller_action' => 'Modules\\Sisrute\\Http\\Controllers\\ReferensiController@kriteriaKhusus',
    'permission' => 'sisrute.referensi.kriteria-khusus',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3028 => 
  array (
    'controller_action' => 'Modules\\Sisrute\\Http\\Controllers\\ReferensiController@kriteriaRujukan',
    'permission' => 'sisrute.referensi.kriteria-rujukan',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3029 => 
  array (
    'controller_action' => 'Modules\\Sisrute\\Http\\Controllers\\ReferensiController@kriteriaMatneo',
    'permission' => 'sisrute.referensi.kriteria-matneo',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3030 => 
  array (
    'controller_action' => 'Modules\\SisruteResumeMedis\\Http\\Controllers\\SisruteResumeMedisController@index',
    'permission' => 'sisrute-resume-medis.sisrute-resume-medis.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3031 => 
  array (
    'controller_action' => 'Modules\\SisruteResumeMedis\\Http\\Controllers\\SisruteResumeMedisController@store',
    'permission' => 'sisrute-resume-medis.sisrute-resume-medis.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3032 => 
  array (
    'controller_action' => 'Modules\\Sitb\\Http\\Controllers\\SitbController@index',
    'permission' => 'sitb.sitb.index',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3033 => 
  array (
    'controller_action' => 'Modules\\Sitb\\Http\\Controllers\\SitbController@store',
    'permission' => 'sitb.sitb.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3034 => 
  array (
    'controller_action' => 'Modules\\Sitb\\Http\\Controllers\\SitbController@show',
    'permission' => 'sitb.sitb.show',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3035 => 
  array (
    'controller_action' => 'Modules\\Sitb\\Http\\Controllers\\SitbController@update',
    'permission' => 'sitb.sitb.update',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3036 => 
  array (
    'controller_action' => 'Modules\\SystemLicenseGuard\\Http\\Controllers\\LicenseController@status',
    'permission' => 'system-license-guard.license.status',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  3037 => 
  array (
    'controller_action' => 'Modules\\SystemLicenseGuard\\Http\\Controllers\\LicenseController@fingerprint',
    'permission' => 'system-license-guard.license.fingerprint',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  3038 => 
  array (
    'controller_action' => 'Modules\\SystemLicenseGuard\\Http\\Controllers\\LicenseController@activate',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  3039 => 
  array (
    'controller_action' => 'Modules\\SystemLicenseGuard\\Http\\Controllers\\LicenseController@sync',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  3040 => 
  array (
    'controller_action' => 'Modules\\SystemLicenseGuard\\Http\\Controllers\\LicenseController@webhook',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  3041 => 
  array (
    'controller_action' => 'Modules\\SystemTteDocument\\Http\\Controllers\\TteDocumentController@index',
    'permission' => 'system-tte-document.tte-document.index',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  3042 => 
  array (
    'controller_action' => 'Modules\\SystemTteDocument\\Http\\Controllers\\TteDocumentController@show',
    'permission' => 'system-tte-document.tte-document.show',
    'legacy_tier' => 'authenticated_any',
    'is_public' => false,
  ),
  3043 => 
  array (
    'controller_action' => 'Modules\\SystemTteDocument\\Http\\Controllers\\TteDocumentController@store',
    'permission' => 'system-tte-document.tte-document.store',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3044 => 
  array (
    'controller_action' => 'Modules\\SystemTteDocument\\Http\\Controllers\\TteDocumentController@submitForSign',
    'permission' => 'system-tte-document.tte-document.submit-for-sign',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3045 => 
  array (
    'controller_action' => 'Modules\\SystemTteDocument\\Http\\Controllers\\TteDocumentController@sign',
    'permission' => 'system-tte-document.tte-document.sign',
    'legacy_tier' => 'petugas_admin',
    'is_public' => false,
  ),
  3046 => 
  array (
    'controller_action' => 'Modules\\SystemTteDocument\\Http\\Controllers\\TteDocumentController@lock',
    'permission' => 'system-tte-document.tte-document.lock',
    'legacy_tier' => 'admin_only',
    'is_public' => false,
  ),
  3047 => 
  array (
    'controller_action' => 'GET storage/{path}',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
  3048 => 
  array (
    'controller_action' => 'PUT storage/{path}',
    'permission' => NULL,
    'legacy_tier' => 'public',
    'is_public' => true,
  ),
);
