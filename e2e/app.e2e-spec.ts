import { Co.Edu.Usbcali.QuiscosPage } from './app.po';

describe('co.edu.usbcali.quiscos App', () => {
  let page: Co.Edu.Usbcali.QuiscosPage;

  beforeEach(() => {
    page = new Co.Edu.Usbcali.QuiscosPage();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});
