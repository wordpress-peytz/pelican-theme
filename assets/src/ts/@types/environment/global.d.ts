declare global {
  interface Window {
    pelicanSettings: {
      [ key: string ]: any;
    };
  }
}

export {};
