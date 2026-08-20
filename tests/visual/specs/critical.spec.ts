import { test, expect } from '@playwright/test';

async function gotoCritical(page: import('@playwright/test').Page, theme: 'light' | 'dark' = 'light') {
  await page.goto('/slate-critical');
  await expect(page.getByTestId('smoke-button')).toBeVisible();
  if (theme === 'dark') {
    await page.evaluate(() => document.documentElement.classList.add('dark'));
  }
}

test('01 critical light', async ({ page }) => {
  await gotoCritical(page, 'light');
  await expect(page).toHaveScreenshot('01-critical-light.png', { fullPage: true });
});

test('02 critical dark', async ({ page }) => {
  await gotoCritical(page, 'dark');
  await expect(page).toHaveScreenshot('02-critical-dark.png', { fullPage: true });
});

test('03 button light', async ({ page }) => {
  await gotoCritical(page, 'light');
  await expect(page.getByTestId('section-button')).toHaveScreenshot('03-button-light.png');
});

test('04 button dark', async ({ page }) => {
  await gotoCritical(page, 'dark');
  await expect(page.getByTestId('section-button')).toHaveScreenshot('04-button-dark.png');
});

test('05 input-error light', async ({ page }) => {
  await gotoCritical(page, 'light');
  await expect(page.getByTestId('section-input-error')).toHaveScreenshot('05-input-error-light.png');
});

test('06 input-error dark', async ({ page }) => {
  await gotoCritical(page, 'dark');
  await expect(page.getByTestId('section-input-error')).toHaveScreenshot('06-input-error-dark.png');
});

test('07 dialog open light', async ({ page }) => {
  await gotoCritical(page, 'light');
  await page.getByTestId('smoke-dialog-trigger').click();
  await expect(page.getByText('Edit profile')).toBeVisible();
  await expect(page.locator('[data-slot="dialog-content"]')).toHaveScreenshot('07-dialog-open-light.png');
});

test('08 dialog open dark', async ({ page }) => {
  await gotoCritical(page, 'dark');
  await page.getByTestId('smoke-dialog-trigger').click();
  await expect(page.getByText('Edit profile')).toBeVisible();
  await expect(page.locator('[data-slot="dialog-content"]')).toHaveScreenshot('08-dialog-open-dark.png');
});

test('09 toast light', async ({ page }) => {
  await gotoCritical(page, 'light');
  await page.getByTestId('smoke-toast-trigger').click();
  await expect(page.getByText('Saved')).toBeVisible();
  await expect(page.locator('[data-slot="toaster"]')).toHaveScreenshot('09-toast-light.png');
});

test('10 toast dark', async ({ page }) => {
  await gotoCritical(page, 'dark');
  await page.getByTestId('smoke-toast-trigger').click();
  await expect(page.getByText('Saved')).toBeVisible();
  await expect(page.locator('[data-slot="toaster"]')).toHaveScreenshot('10-toast-dark.png');
});
